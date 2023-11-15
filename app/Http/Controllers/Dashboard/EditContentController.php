<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Basic;
use App\Models\ConsultationMsg;
use App\Models\Customer;
use App\Models\Governance;
use App\Models\Privacy;
use App\Models\Privreturn;
use App\Models\Term;
use Illuminate\Http\Request;

class EditContentController extends Controller
{
    // get basic data view 
    public function index(){
        $basicData = Basic::with('media')->first();
        return view('dashboard.editcontent.index',compact('basicData'));
    }

    // update basic data content 
    public function basicDataUpdate(Request $request){
          $request->validate([
            'name'=>['required','string'],
            'description'=>['required','string'],
            'phone'=>['required','numeric'],
            'whatsapp'=>['required','numeric'],
            'email'=>['required','email'],
            'address'=>['required','string'],
            // 'facebook'=>['string'],
            // 'instagram'=>['string'],
            // 'snapchat'=>['string'],
            // 'linkedin'=>['string'],
            // 'twitter'=>['string'],
          ],
          [
            'name.required'=>'حقل الاسم مطلوب',
            'description.required'=>'حقل الوصف مطلوب',
            'name.string'=>'حقل الاسم يجب ان يكون نصي فقط' ,
            'description.string'=>'حقل الوصف يجب ان يكون نصي فقط',
            'phone.required'=>'حقل الهاتف مطلوب',
            'phone.numeric'=>'حقل الهاتف يجب ان يكون ارقام فقط',
            'whatsapp.required'=>'حقل الواتس اب مطلوب',
            'whatsapp.required'=>'حقل الواتس يجب ان يكون ارقام فقط',
            'email.required'=>'حقل البريد الالكتروني مطلوب',
            'email.email'=>'يجب كتابة صيغة البريدالالكتروني صحيحه',
            'address.required'=>'حقل العنوان مطلوب',
            'address.string'=>'حقل العنوان يجب ان يكون نصي فقط',
            // 'facebook.string'=>'يجب كتابة رابط الفيس بوك بشكل صحيح',
            // 'instagram.string'=>'يجب كتابة رابط الانستقرام بشكل صحيح',
            // 'snapchat.string'=>'يجب كتابة رابط اسناب شات بشكل صحيح',
            // 'linkedin.string'=>'يجب كتابة رابط لينكدان بشكل صحيح',
            // 'twitter.string'=>'يجب كتابة رابط تويتر بشكل صحيح',
          ]);
          
          
          //  Basic::query()->delete();
          $basicUpdate = Basic::limit(1)->first();
          $basicUpdate->where('id',$basicUpdate->id)->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'phone'=>$request->phone,
            'whatsapp'=>$request->whatsapp,
            'email'=>$request->email,
            'address'=>$request->address,
            'facebook'=>$request->facebook,
            'instagram'=>$request->instagram,
            'snapchat'=>$request->snapchat,
            'linkedin'=>$request->linkedin,
            'twitter'=>$request->twitter
          ]);
          if($request->hasFile('logo')){
            $basicUpdate->clearMediaCollection('logo');
            $basicUpdate->addMedia($request->file('logo'))
                    ->usingName('Content images')
                    ->toMediaCollection('logo');
          }
      
          if($request->hasFile('icon')){
            $basicUpdate->clearMediaCollection('icon');
            $basicUpdate->addMedia($request->file('icon'))
                    ->usingName('Content images')
                    ->toMediaCollection('icon');
          }

          return redirect()->route('basic.data.view')->with('success','تم تعديل البيانات الاساسية بنجاح');
    }


    // get about edit view
    public function aboutView(){
      $about = About::with('media')->first();
      $basicData = Basic::with('media')->first();

      return view('dashboard.editcontent.editabout',compact('about','basicData'));
    }
    // update about data
    public function aboutDataUpdate(Request $request,$id){
      
      $request->validate([
        'short_text'=>['required','string'],
        'content'=>['required','string']
      ],
      [
        'short_text.required'=>'حقل الجمله التوضيحيه مطلوب',
        'short_text.string'=>'يجب ان يكون حقل الجمله التوضيحيه نصي',
        'content.required'=>'حقل المحتوي مطلوب',
        'content.string'=>'يجب ان يكون حقل المحتوي نصي'

      ]);
      $about = About::where('id',$id)->first();
      $about->update([
        'short_text'=>$request->short_text,
        'content'=>$request->content,
      ]);
      
      if($request->hasFile('image')){
          $request->validate([
            'image'=>['required','image'],
          ],
          [
            'image.required'=>'حقل الصور مطلوب',
            'image.image'=>'يجب ان يكون حقل الصوره يحتوي علي صوره',
          ]);
          $about->clearMediaCollection('about');
          $about->addMedia($request->file('image'))
                  ->usingName('About image')
                  ->toMediaCollection('about');
      }

      return redirect()->route('about.data.view')->with('success','تم تعديل بيانات من نحن بنجاح');

      

      
    }


    // get home edit view
    public function homeView(){
      $basicData = Basic::with('media')->first();

      $homePageData = Governance::query()->first();
      $homeconsultationmsg = ConsultationMsg::query()->first();
      $customerFeedBackDatas = Customer::all();
      $customersRate = Customer::latest()->with('media')->get();
      return view('dashboard.editcontent.edithome',compact('homePageData','homeconsultationmsg','customerFeedBackDatas','customersRate','basicData'));
    }

    // update governances update data 
    public function homeGovernancesUpdate(Request $request,$id){
      
      $request->validate([
          'section_description'=>['required','string'],
          'description_one'=>['required','string'],
          'description_two'=>['required','string'],
          'description_three'=>['required','string'],
          'status'=>['required','in:active,archived']
      ],
      [
        'section_description.required'=>'حقل وصف السكشن مطلوب',
        'section_description.string'=>'حقل الوصف يجب ان يكون نصي',

        'description_one.required'=>'حقل الوصف الاول مطلوب',
        'description_one.string'=>'حقل الوصف الاول يجب ان يكون نصي',

        'description_two.required'=>'حقل الوصف الثاني مطلوب',
        'description_two.string'=>'حقل الوصف الثاني يجب ان يكون نصي',

        'description_three.required'=>'حقل الوصف الثالث مطلوب',
        'description_three.string'=>'حقل الوصف الثالث يجب ان يكون نصي',
        
        'status.required'=>'يرجي تحديد الحالة',
        'status.in'=>'يجب اختيار الحالة مفعله او غير مفعله'
      ]);

      Governance::where('id',$id)->update([
        'section_description'=>$request->section_description,
        'description_one'=>$request->description_one,
        'description_two'=>$request->description_two,
        'description_three'=>$request->description_three,
        'status'=>$request->status
      ]);

      return redirect()->route('home.data.view')->with('success','تم تعديل بيانات قسم الحوكمة بنجاح');

    }

    //update consultation msg update data
    public function homeConsultationmsgUpdate(Request $request,$id){

      $request->validate([
        'consultation_msg'=>['required','string'],
      ],
      [
        'consultation_msg.required'=>'حقل وصف سكشن الاستشارة مطلوب',
        'consultation_msg.string'=>'حقل وصف سكشن الاستشارة يجب ان يكون نصي',
      ]);

      ConsultationMsg::where('id',$id)->update([
        'consultation_msg'=>$request->consultation_msg
      ]);

      return redirect()->route('home.data.view')->with('success','تم تعديل بيانات قسم الاستشارة بنجاح');

    }


    // get privacy view
    public function privacyView(){
      $privacy = Privacy::query()->first();
      $basicData = Basic::with('media')->first();

      return view('dashboard.editcontent.editprivacy',compact('privacy','basicData'));
    }
    public function privacyDataUpdate(Request $request,$id){
      $request->validate([
        'content'=>['required','string'],
      ],
      [
        'content.required'=>'حقل المحتوي مطلوب',
        'content.string'=>'يجيب ان يكون حقل المحتوي نصي',
      ]);
      Privacy::where('id',$id)->update([
        'content'=>$request->content,
      ]);
      return redirect()->route('privacy.data.view')->with('success','تم تعديل بيانات السياسية والخصوصية بنجاح');

    }

    // get terms view
    public function termsDataView(){
      $term = Term::query()->first();
      $basicData = Basic::with('media')->first();

      return view('dashboard.editcontent.editterms',compact('term','basicData'));
    }

    // terms data update
    public function termsDataUpdate(Request $request,$id){
        $request->validate([
          'content'=>['required','string'],
        ],
        [
          'content.required'=>'حقل محتوي الشروط والاحكام مطلوب',
          'content.string'=>'يجب ان يكون حقل الشروط والاحكام نصي',
        ]);
        Term::where('id',$id)->update([
          'content'=>$request->content
        ]);

        return redirect()->route('terms.data.view')->with('success','تم تعديل الشروط والاحكام بنجاح');

    }

    // get return data view
    public function returnDataView(){
      $return = Privreturn::query()->first();
      $basicData = Basic::with('media')->first();

      return view('dashboard.editcontent.editreturn',compact('return','basicData'));
    }
    // update return 
    public function returnDataUpdate(Request $request,$id) {
      $request->validate([
        'content'=>['required','string'],
      ],
      [
        'content.required'=>'حقل محتوي سياسة الاسترجاع مطلوب',
        'content.string'=>'يجب ان يكون حقل سياسة الاسترجاع نصي',
      ]);
      Privreturn::where('id',$id)->update([
        'content'=>$request->content,
      ]);
      return redirect()->route('terms.data.view')->with('success','تم تعديل سياسة الاسترجاع بنجاح');

    }

    // customer rate update status
    public function customerRateUpdate(Request $request ,$id){
      Customer::find($id)->update([
        'status'=>$request->status,
      ]);
      return redirect()->route('home.data.view')->with('success','تم تعديل رأي العميل بنجاح');
    }
    // customer rate delete row
    public function customerRatedelete($id){
      Customer::find($id)->delete();
      return redirect()->route('home.data.view')->with('success','تم حذف رأي العميل بنجاح');

    }
    
}
