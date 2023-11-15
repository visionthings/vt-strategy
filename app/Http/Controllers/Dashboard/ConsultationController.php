<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConsultationRequest;
use App\Models\Consultation;
use App\Models\Date;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allConsultations = Consultation::with('dates','admin')->latest()->paginate(10);
        return view('dashboard.consultations.index',compact('allConsultations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.consultations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ConsultationRequest $request)
    {   
        $request->merge([
            'admin_id'=>Auth::guard('admin')->id(),
        ]);
        if($request->tax){
            $request->merge([
                'tax_price'=>$request->price + ($request->price * $request->tax / 100),
                'tax'=>$request->tax
            ]);
        } 
        Consultation::create($request->all());
                        // ->dates()
                        // ->createMany(array_map(
                        // function ($date) 
                        // {
                        //     return ['date' => $date];
                        // },$request->date));
        return redirect()->route('consultations.index')->with('success','تم اضافة الاستشارة بنجاح');                        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $consultation = Consultation::where('id',$id)->with('dates')->first();
        return view('dashboard.consultations.show',compact('consultation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ConsultationRequest $request, string $id)
    {

            $update = Consultation::where('id',$id)->first();
            $update->name=$request->name;
            $update->admin_id = Auth::guard('admin')->id();
            $update->price=$request->price;
            $update->tax=$request->tax;
            $update->status=$request->status;
            

        if($request->tax){
            $update->tax_price = $request->price + ($request->price * $request->tax / 100);
            $update->tax = $request->tax;
        } else{
            $update->tax_price = $request->price;
        }
        $update->save();
        
        // $update->dates()->update(['date'=>$request->date]);
        
        // ->createMany(array_map(function ($date) 
        // {
        //     return ['date' => $date];
        // },$request->date));

        return redirect()->route('consultations.index')->with('success','تم تعديل الاستشارة بنجاح');  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consultation $consultation)
    {
        $consultation->delete();
        return redirect()->route('consultations.index')->with('delete','تم حذف الاستشارة بنجاح');  
    }

    public function ConsultationUpdateDateMethod(Request $request,$id){
        Date::where('id',$id)->update([
            'status'=>$request->status
        ]);
        return redirect()->back()->with('success','تم تعديل الموعد بنجاح');
    }
    public function ConsultationDeleteDateMethod(Request $request,$id){
        Date::where('id',$id)->delete();
        return redirect()->back()->with('delete','تم حذف الموعد بنجاح');
    }
    

}
