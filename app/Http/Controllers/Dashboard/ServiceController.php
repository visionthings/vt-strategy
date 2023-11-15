<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::with('contents','admin')->latest()->paginate(10);
        return view('dashboard.services.index',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image'=>['required','image','mimes:png,jpg'],
            'name'=>['required','string'],
            'status'=>['required','in:active,archived'],
            'description'=>['required','string'],
            'important'=>['nullable','in:0,1'],
        ],[
            'image.required'=>'حقل الصورة مطلوب',
            'image.image'=>'حقل الصورة يجب أن يكون صورة حقيقية',
            'image.mimes'=>'حقل الصوره يجب أن يكون صيغة الصورة png أو jpg',
            'name.required'=>'حقل الاسم مطلوب',
            'name.string'=>'حقل الاسم يجب أن يكون نصي',
            'description.required'=>'حقل الوصف مطلوب',
            'description.string'=>'يجب ان يكون حقل الوصف نصي',
            'status.required'=>'حقل الحالة مطلوب',
            'status.in'=>'حقل الحالة يجب أن يكون مؤشف او نشط',
            'important.in'=>'يجب ان يكون قيمة حقل مهمة تكون 0 او 1 فقط',
        ]);
        
        $request->merge([
            'admin_id'=>Auth::guard('admin')->id(),
        ]);
        if(!$request->important){
            $request->merge([
                'important'=>'0',
            ]);
        }
        $service = Service::create($request->all());
        if($request->hasFile('image')){
            $image = $request->file('image');
            $service->addMedia($image)->usingName('Service images')->toMediaCollection('service');
        }
        
        // if($request->has('image')){
        //     $image = $request->file('image');
        //     $update->clearMediaCollection('content');            
        //     $update->addMedia($image)->usingName('Content images')->toMediaCollection('content');
        // }
        return redirect()->route('services.index')->with('success','تم إضافة الخدمة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {   
        $service =  Service::with('contents')->where('id',$id)->first();
        $services = Service::where('status','active')->get();
        $contents = $service->contents()->latest()->paginate(10);
        
        return view('dashboard.services.show',compact('service','services','contents'));
    }

  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>['required','string'],
            'status'=>['required','in:active,archived'],
            'description'=>['required','string'],
            'important'=>['nullable','in:0,1'],
        ],
        [
            'name.required'=>'حقل الاسم مطلوب',
            'name.string'=>'حقل الاسم يجب أن يكون نصي',
            'description.required'=>'حقل الوصف مطلوب',
            'description.string'=>'يجب ان يكون حقل الوصف نصي',
            'status.required'=>'حقل الحالة مطلوب',
            'status.in'=>'حقل الحالة يجب أن يكون مؤشف او نشط',
            'important.in'=>'يجب ان يكون قيمة حقل مهمة تكون 0 او 1 فقط',
        ]);

        if(!$request->important){
            $important = '0';
        } else {
            $important = '1';
        }
        $service = Service::where('id',$id)->first();
        $service->update([
            'name'=>$request->name,
            'status'=>$request->status,
            'description'=>$request->description,
            'important'=>$important,
        ]);

        if($request->hasFile('image')){
            $service->clearMediaCollection('service');            
            $image = $request->file('image');
            $service->addMedia($image)->usingName('Service images')->toMediaCollection('service');
        }

        return redirect()->route('services.index')->with('success','تم تعديل الخدمة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('delete','تم حذف الخدمة بنجاح');
    }
}
