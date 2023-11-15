<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Basic;
use App\Models\Consultation;
use App\Models\Consultion_booking;
use App\Models\Contact;
use App\Models\Content;
use App\Models\Customer;
use App\Models\Date;
use App\Models\Service;
use App\Models\Time;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Moyasar\Moyasar;
use Moyasar\Providers\PaymentService;
use Moyasar\Providers\InvoiceService;


class FrontController extends Controller
{

    //All Articals
    public function articals(){
        $contents = Content::with('service','media')->latest()->paginate(4);
        $basic = Basic::query()->first();
        return view('articals',compact('contents','basic'));
    }
    //Show articale
    public function show($slug){
       $content = Content::where('slug',$slug)->with('service','media')->first();
       $basic = Basic::query()->first();
       return view('article',compact('content','basic'));
    }

    // Consultation search
    public function consultationSearch(Request $request){

        // $consultationsResult = Consultation::where('name','like', '%' . $request->query('consultation_name') . '%')
        //                            ->with(['dates'=>fn($q)=>
                                    
        //                               // $q->join('times', function ($join) {
        //                               //     $join->on('times.date_id', '=', 'dates.id');
        //                               // })


        //                               $q->select(DB::raw('date as day'),'consultation_id', DB::raw('COUNT(*) as count'))
        //                               ->groupBy('day', 'consultation_id')
        //                               ])->get();

        $consultationsResult = Consultation::where('name','like', '%' . $request->query('consultation_name') . '%')
                                ->with(['dates'=>fn($q)=>$q->whereDate('date','!=',Carbon::today())
                                ->where('status','active')
                                ->with('times')])
                                ->get();
        $basic = Basic::with('media')->first();


        return view('consultationsearch',compact('consultationsResult','basic'));
    }

    // Consultion date edit view 
    public function consultationDateEdit($id){
      $date = Date::where('id',$id)->with('times')->first();
      return view('dashboard.consultations.date.index',compact('date'));
    }

    // Consultion date store 
    public function consultationAddDate(Request $request,$id){
       Date::create([
         'consultation_id'=>$id, 
         'date'=>$request->date,
       ]);
       return redirect()->back()->with('success','تم اضافة التاريخ بنجاح');
    }

    // // Consultation times update or create
    public function consultationTimesUpdateOrCreate(Request $request,$id){
      
        // $request->validate([
        //   'from_time.*'=>['required'],
        // ],
        // [
        //   'from_time.*.required'=>'حقل الوقت مطلوب (من)',
        // ]);
    
        $Date = Date::where('id',$id)->first();
        $Date->update([
          'date'=>$request->date,
        ]);

        $Date->times()->delete();
       
       $times = collect($request->from_time)->zip($request->to_time);
        $insertTimeData = [];
          foreach($times as $time){
              $insertTimeData[] = [
                    'date_id'=>$Date->id,
                    'from_time' => $time[0],
                    'to_time' => $time[1],
              ];
          }


        Time::insert($insertTimeData);  
        
        //  $Date->times()->createMany(array_map(function ($date) {
        //     return [$date->from_time];
        // },$request->from_time));

        // foreach($request->from_time as $from_time){
        //   foreach($request->to_time as $to_time){
            
        //   }
        //   TimeModel::create([
        //     'date_id'=>$Date->id,
        //     'from_time'=>$from_time,
        //     'to_time'=>$to_time
        //     ]);
        // }
       
        


        return redirect()->back()->with('success','تم تعديل الوقت للتاريخ المطلوب');
    }


    // Get consultation booking view
    public function consultationBooking($consultation_id,$time_id){

      $consultation = Consultation::where('id',$consultation_id)->first();
      $time = Time::where('id',$time_id)->first();
      $basic = Basic::query()->first();

      return view('consultation_booking',compact('consultation','time','basic'));
    }


    // get payment view
    public function paymentView($price,$consultation_id){
      // return $consultation_id;
      $consultion_bookinged = Consultion_booking::where('id',$consultation_id)->with('consultion')->first();
      $consultion = $consultion_bookinged->consultion;
      $basic = Basic::query()->first();
      return view('payment.payment',compact('basic','price','consultation_id','consultion'));
    }
    // Create consultion by user (booking consultion)
    public function consultationBookingCreate(Request $request){
        $request->validate([
          'name'=>['required','string','max:255'],
          'phone'=>['required','numeric'],
          'email'=>['required','nullable','email'],
          'consultion_id'=>['required','exists:consultations,id'],
          'time_id'=>['required','exists:times,id'],
        ],
        [
          'name.required'=>'حقل الاسم مطلوب',
          'name.string'=>'يجب ان يكون حقل الاسم نصي',
          'phone.required'=>'حقل الهاتف مطلوب',
          'email.required'=>'حقل البريد مطلوب',
          'email.email'=>'يرجي كتابة حقل البريد بشكل صحيح',
          'consultion_id.required'=>'حدث خطاء في الاستشاره المحدده',
          'consultion_id.exists'=>'عفوا الاستشارة المحدده غير موجودة',
          'time_id.exists'=>'عفوا الوقت المحدد غير موجود',
        ]);

        

      $getConsultion = Consultation::where('id',$request->consultion_id)->first();
      $getTime = Time::where('id',$request->time_id)->first();

      if(Auth::check()){
        $request->merge([
          'user_id'=>Auth::user()->id,
          'from_time'=>$getTime->from_time,
          'to_time'=>$request->to_time,
        ]);
      }
      $consultionBooking= Consultion_booking::create($request->all());

      return redirect()->route('payment.view', 
       [
        'getConsultionTaxPrice'=>$getConsultion->tax_price,
        'consultionBooking_id'=>$consultionBooking->id,
       ]
      )->with('success','لاستكمال حجز الاستشارة يرجي استكمال عملية الدفع',);


      // return view('payment.payment',compact('consultionBooking','getConsultion'))->with('success','تم حجز الاستشارة بنجاح');

    } 


    //update payment for user after call back request 
    public function updateUserPaymentStatus(Request $request,$id){
 
     
       

        $updateUserConsultionsBooked = Consultion_booking::where('id',$id)->first();

        if($request->query('status') =="failed"){
          $updateUserConsultionsBooked->update([
            'payment_status'=>'failed'
          ]);
          return redirect()->back()->with('paidFaild','حدث خطاء اثناء الدفع يرجي المحاولة مره اخري');
        }

        $updateUserConsultionsBooked->update([
          'payment_status'=>'paid'
        ]);
        $getConsultionAndINcrementOrderCount = Consultation::where('id',$updateUserConsultionsBooked->consultion_id)->first();
        $getConsultionAndINcrementOrderCount->increment('order_count',1);

      return redirect()->route('index')->with('success','تم الدفع بنجاح');
    }




    //get reservation view 
    public function reservation(){
      $basic = Basic::with('media')->first();
      $consultions = Consultation::where('status','active')->get();
      return view('reservation',compact('basic','consultions'));

    }

    // user contact us
    public function contactUs(Request $request){
      $request->validate([
        'name'=>['required','string','max:255'],
        'phone'=>['required','string'],
        'email'=>['nullable','email'],
        'subject'=>['required','string','max:255'],
        'content'=>['required','string'],
      ],
      [
       'name.required' =>'حقل الاسم مطلوب',
       'name.string' =>'حقل الاسم يجب ان يكون نصي',
       'name.max'=>'الحد الاقصي لحقل الاسم هوه 255 حرف ',
       'phone.required'=>'حقل الهاتف مطلوب',
       'phone.string'=>'يرجي كتابة رقم الهاتف صحيح',
       'email.email'=>'يرجي كتابة حقل البريد صحيح',
       'subject.required'=>'حقل عنوان الرساله مطلوب',
       'subject.string'=>'حقل عنوان الرساله يجب ان يكون نصي',
       'subject.max'=>'الحد الاقصي لحقل عنوان الرساله هوه 255 حرف',
       'content.required'=>'حقل المحتوي مطلوب',
       'content.string'=>'حقل المحتوي يجب ان يكون نصي',
      ]);

      Contact::create($request->all());
      return redirect()->route('index')->with('success','شكرا للتواصل تم ارسال الرساله بنجاح');
    }



    // get about view 
    public function aboutView(){
      $basic = Basic::query()->first();
      $about = About::query()->first();
      return view('about',compact('basic','about'));
    }
    // get services view
    
    public function servicesView(){
      $basic = Basic::query()->first();
      $services = Service::where('status','active')->latest()->paginate(2);
      return view('services',compact('basic','services'));
    }

    // get services articales
    public function showServiceArticales($id){
      $basic = Basic::query()->first();
      $articales = Service::where('id',$id)->with('contents')->first();

      return view('service_articales',compact('articales','basic'));
    }

    // get contact view
    public function contactView(){
      $basic = Basic::query()->first();
      return view('contact',compact('basic'));
    }

    // user info 
    // get user edit info view
    public function userinfo(){
      $basic=Basic::query()->first();
      return view('userinfo',compact('basic'));
    }
    // uer info update method 
    public function  userinfoUpdate(Request $request) {
      $request->validate([
        'name'=>['required','string','max:255'],
        'email'=>['required','email',Rule::unique('users','email')->ignore(Auth::user()->id)],
        'phone'=>['required','numeric',Rule::unique('users','phone')->ignore(Auth::user()->id)],
      ],
      [
        'name.required'=>'حقل الاسم مطلوب',
        'name.string'=>'حقل الاسم يجب أن يكون نصي',
        'name.max'=>'حقل الاسم يجب أن يكون من 1 الي 255 حرف',
        'email.required'=>'حقل البريد الالكتروني مطلوب',
        'email.email'=>'خطاء في البريد الالكتورني',
        'email.unique'=>'هذا البريد الالكتروني موجود سابقا',
        'phone.required'=>'حقل الهاتف مطلوب',
        'phone.numeric'=>'خطاء في رقم الهاتف ',
        'phone.unique'=>'رقم الهاتف موجود سابقا',
        
      ]);
      User::find(Auth::user()->id)->update($request->all());
      return redirect()->route('userinfo')->with('success','تم تعديل بياناتك بنجاح');
    }

    // get user consultion booked view
    public function userConsultbooked(){
      $basic=Basic::query()->first();
      $getUserConsultionsbooking = User::where('id',Auth::user()->id)->with(['consultionsbooking'=>fn($q)=>$q->where('status','pending')->with('consultion')
      ])->first();
      $getUserSuccessConsultionsbookinged = User::where('id',Auth::user()->id)->with(['consultionsbooking'=>fn($q)=>$q->where('status','success')->with('consultion')
      ])->first();
      return view('consultbooked',compact('basic','getUserConsultionsbooking','getUserSuccessConsultionsbookinged'));
    }


    
    // update customer feedback data
    public function homeCustomerFeedbackUpdate(Request $request,$consultation_id){
      
      $request->validate([

        'avatar'=>['image'],

        'name'=>['required','string'],

        'rate'=>['required','in:1,2,3,4,5'],

        'job_name'=>['required','string'],

        'comment'=>['required','string'],
        // 'status'=>['required','in:active,no_active'],

      ],
      [

        'avatar.image'=>'يجب ان يكون نوع الملف صورة صحيحه',

        'name.required'=>'اسم العميل مطلوب',
        'name.string'=>'يجب ان يكون اسم العميل نصي',

      
        'rate.required'=>'حقل التقيم مطلوب',
        'rate.in'=>'يجب ان يكون حقل التقيم من 1 الي 5 فقط',


        'job_name.required'=>'حقل وظيفة العميل مطلوب',
        'job_name.string'=>'يجب ان يكون حقل وظيفة العميل نصي',

        
        'comment.required'=>'حقل التعليق مطلوب',
        'comment.string'=>'يجب ان يكون حقل التعليق نصي',
        // 'status.required'=>'يجب تحديد حالة',
        // 'status.in'=>'يجب اختيار اول او عادي',

      ]);
      $request->merge([
        'status'=>'active',
      ]);
      $customer = Customer::where('consultation_id',$consultation_id)->first();
      if($customer){
        return redirect()->route('consultbooked')->with('error','تم إضافة رايك سابقا لهذا الاستشارة');
      }

      $customerCreate = Customer::create([
          'name'=>$request->name,
          'rate'=>$request->rate,
          'job_name'=>$request->job_name,
          'comment'=>$request->comment,
          'status'=>$request->status,
          'consultation_id'=>$consultation_id
      ]);

      if ($request->has('avatar')) {
          // $customer->clearMediaCollection('customer');
          $avatar = $request->file('avatar');
          $customerCreate->addMedia($avatar)
                   ->usingName('Customer images')
                   ->toMediaCollection('customer');
      }

    
     return redirect()->route('consultbooked')->with('success',' تم اضافة رأيك بنجاح شكرا لك');

  
}

} 
