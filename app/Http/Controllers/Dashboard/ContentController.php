<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>['required','string','unique:contents,title'],
            'service_id'=>['required','exists:services,id'],
            'content'=>['required'],
            'yt_video'=>['string'],
            'intro'=>['required','string'],
            'image'=>['required','mimes:jpeg,jpg,png'],
        ],
        [
            'title.required'=>'حقل العنوان مطلوب',
            'title.string'=>'حقل العنوان يجب أن يكون نصي',  
            'title.unique'=>'هذا العنوان موجود مسبقا',
            'service_id.required'=>'يرجي تحديد الخدمة التابع لها النشور',
            'service_id.exists'=>'عفوا هذا الخدمة غير موجوده',
            'content.required'=>'المحتوي مطلوب' ,
            'intro.required'=>'مقدمة المقال مطلوبة',
            'image.required'=>'صورة المشنور مطلوبة',
            'image.mimes'=>'يجب أن يكون نوع الصوره jpeg / jpg /png',
        ]);

        $request->except('image');
        $request->merge([
            'slug'=>Str::slug($request->title),
        ]);
        $content = Content::create($request->all());
        if($request->has('image')){
            $image = $request->file('image');
            $content->addMedia($image)
                     ->usingName('Content images')
                     ->toMediaCollection('content');
        }
        return redirect()->route('admin.index')->with('success','تم اضافة المنشور بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {

        $request->validate([
            'title'=>['required','string',Rule::unique('contents','title')->ignore($id)],
            'content'=>['required'],
            'service_id'=>['required','exists:services,id'],
            'yt_video'=>['string'],
            'intro'=>['required','string'],
            'image'=>['required','mimes:jpeg,jpg,png'],
        ],
        [
            'title.required'=>'حقل العنوان مطلوب',
            'title.string'=>'حقل العنوان يجب أن يكون نصي',  
            'title.unique'=>'هذا العنوان موجود مسبقا',
            'content.required'=>'المحتوي مطلوب' ,
            'service_id.required'=>'يرجي تحديد الخدمة التابع لها النشور',
            'service_id.exists'=>'عفوا هذا الخدمة غير موجوده',
            'intro.required'=>'مقدمة المقال مطلوبة',
            'image.required'=>'صورة المشنور مطلوبة',
            'image.mimes'=>'يجب أن يكون نوع الصوره jpeg / jpg /png',
        ]);

        $update = Content::where('id',$id)->update([
            'service_id'=>$request->service_id,
            'title'=>$request->title,
            'slug'=>Str::slug($request->title),
            'intro'=>$request->intro,
            'content'=>$request->content,
            'yt_video'=>$request->yt_video,
            'status'=>$request->status,
        ]);
        if($request->has('image')){
            $image = $request->file('image');
            $update->clearMediaCollection('content');            
            $update->addMedia($image)->usingName('Content images')->toMediaCollection('content');
        }
        return redirect()->back()->with('success','تم تعديل المنشور بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content)
    {
        $content->delete();
        return redirect()->back()->with('delete','تم حذف المنشور بنجاح');
    }
}
