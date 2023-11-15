<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Consultation;
use App\Models\Consultion_booking;
use App\Models\Contact;
use App\Models\Content;
use App\Models\Date;
use App\Models\Service;
use App\Models\User;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use PDO;

class IndexController extends Controller
{
    // data
    public function index(){
        // $consultations = Consultation::with('date')->latest()->get();
        // $dates = Date::all();
        // $availableDate = Date::where('status','available')->get();
        // $doneConsultations =Consultation::where('status','done')->count();
        // $pendingConsultations =Consultation::where('status','pending')->count();
        $services = Service::where('status','active')->get();
        $contents = Content::with('service')->latest()->paginate(10);
        $consultations_bookinged = Consultion_booking::latest()->paginate(10);
        $consultationsSuccess =Consultion_booking::where('status','success')->count();
        $consultationsPending =Consultion_booking::where('status','pending')->count();
        $contacts = Contact::where('status','pending')->count();
        $allContacts = Contact::latest()->get();
        // $consultations_bookinged_chart = Consultion_booking::groupBy()
        $consultion_bookingsGroupByMonthes = DB::table('consultion_bookings')
        ->where('status','success')
        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->get();
        $getViewCount = View::whereDate('created_at', Carbon::today())->count();
        $getContactThisMonth = Contact::whereYear('created_at', date('Y'))->get();
        $weekViews = View::whereBetween('created_at',  [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->get();
        $monthMessages = $getContactThisMonth;
        $weekViewsGroupBy = $weekViews->groupBy('created_at');
        return view('dashboard.index',compact('services','contents','consultations_bookinged','consultationsSuccess','consultationsPending','contacts','allContacts','consultion_bookingsGroupByMonthes','getViewCount','monthMessages','weekViewsGroupBy'));
    }

    // Consultation
    // public function consultationsDestroyMethod($id){
    //     Consultation::where('id',$id)->delete();
    //     return redirect()->route('admin.index')->with('success','تم حذف الاستشارة بنجاح');
    // }

    // public function consultationUpdateMethod(Request $request,$id){
    //     Consultation::where('id',$id)->update([
    //         'date_id'=>$request->date_id
    //     ]);
    //     return redirect()->route('admin.index')->with('success','تم تعديل الاستشارة بنجاح');

    // }

    //date time
    // public function datetimeStoreMethod(Request $request){
    //     // $request->validate([
    //     //     'date'=>['required'],
    //     // ],
    //     // [
    //     //     'required'=>'حقل الموعد مطلوب',
    //     // ]);
    //     // Date::create($request->all());
    //     // return redirect()->route('admin.index')->with('success','تم إضافة الوقت بنجاح');
    // }
    // public function DateDestroyMethod($id){
    //     Date::where('id',$id)->delete();
    //     return redirect()->route('admin.index')->with('success','تم حذف الموعد بنجاح');
    // }


   public function logout(){

    Auth::logout();
    return redirect()->route('admin.login');
   
 }

 public function changePasswordMethod(Request $request){
    $request->validate([
            'password' => 'required|confirmed|min:8',
    ],[
        'password.required'=>'كلمة السر الجديدة مطلوبة',
        'password.confirmed'=>'كلمتي السر غير متطابقين'
    ]);

    $getAdmin = Admin::where('id',Auth::guard('admin')->user()->id)->first();

    if(!Hash::check($request->old_password,$getAdmin->password)){
        return redirect()->route('admin.index')->with('password_error','كلمة السر القديمه غير صحيحه');
    }

    $getAdmin->update([
        'password'=>Hash::make($request->password),
    ]);
    return redirect()->route('admin.index')->with('success','تم تغير كلمة السر بنجاح');
 }



 // consultation user update  meeting link method

 public function consultationUserUpdateMeetingLink(Request $request,$id){
    $request->validate([
        'meeting_link'=>['required'],
    ],
    [
        'meeting_link.required'=>'رابط الاجتماع مطلوب',
        
    ]);

    Consultion_booking::where('id',$id)->update([
        'meeting_link'=>$request->meeting_link,
    ]);
    return redirect()->route('admin.index')->with('success','تم تحديث رابط الاجتماع بنجاح');
 }

 // consultation user update  status  after meeting

 public function consultationUserUpdateStatus(Request $request,$id){
    $request->validate([
        'status'=>['required','in:pending,success,failed'],
    ],
    [
        'status.required'=>'حالةالاستشارة مطلوبة',
        'status.in'=>'يرجي تحديد الحالة  ( غير محدد او ناجحة او فاشلة )',
        
    ]);

    Consultion_booking::where('id',$id)->update([
        'status'=>$request->status,
    ]);
    return redirect()->route('admin.index')->with('success','تم تغير حالة الاستشارة بنجاح');
 }

 // consultation user delete  consultation 
 public function consultationUserDeleteConsultation($id){
    Consultion_booking::where('id',$id)->delete();
    return redirect()->route('admin.index')->with('success','تم حذف الاستشارة بنجاح');

 }
 
  // update content message method
  public function updateContact(Request $request,$id){
    $request->validate([
        'status'=>['required','in:pending,as_readed'],
    ],
    [
        'status.required'=>'حقل الحالة مطلوب',
    ]);
    $contact = Contact::where('id',$id)->first();
    $contact->update([
        'status'=>$request->status,
    ]);
    return redirect()->route('admin.index')->with('success','تم تعديل الرساله بنجاح');
  } 
 // delete contact message method
 public function deleteContact($id){
    Contact::where('id',$id)->delete();
    return redirect()->route('admin.index')->with('success','تم حذف الرساله بنجاح');
 }

 // get admins member view
 public function  adminView() {
    $admins = Admin::paginate(10);
    return view('dashboard.admins.index',compact('admins'));
 }
 // get add admins member view
 public function addAdminView()  {
    return view('dashboard.admins.addadmin');
 }

 // add admin member method
 public function addAdmin(Request $request) {
      $request->validate([
        'first_name'=>['required','string'],
        'last_name'=>['string'],
        'email'=>['required','email','unique:admins,email'],
        'password'=>['required','string'],
        'phone'=>['required','string','unique:admins,phone'],
        'status'=>['required','in:admin,super_admin'],
      ],
      [
       'first_name.required'=>'حقل الاسم الاول مطلوب',
       'first_name.string'=>'يجب ان يكون حقل الاسم الاول نصي',
       'last_name.string'=>'يجب ان يكون حقل الاسم الاخير نصي',
       'email.required'=>'حقل البريد مطلوب',
       'email.email'=>'يجب ان يكون صيغة البريد صحيحه',
       'email.unique'=>'هذا الحساب موجود سابقا',
       'password.required'=>'حقل كلمة السر مطلوب',
       'phone.required'=>'حقل رقم الهاتف مطلوب',
       'phone.unique'=>'هذا الرقم مومود سابقا',
       'status.required'=>'حقل الحالة مطلوب',
       'status.in'=>'يجب تحديد اي من مسؤل او ادارة عليا',
      ]);  
      $request->merge([
        'password'=>Hash::make($request->password),
      ]);
      Admin::create($request->all());

      return redirect()->route('admins.view')->with('success','تم انشاء الحساب بنجاح');
 }

 // get update admin view
 public function updateAdminView($id) {
    
    $admin = Admin::where('id',$id)->first();
    return view('dashboard.admins.updateadmin',compact('admin'));
 }
 // update admin method
 public function updateAdmin(Request $request,$id){
    $request->validate([
        'first_name'=>['required','string'],
        'last_name'=>['string'],
        'email'=>['required','email',Rule::unique('admins','email')->ignore($id)],
        'password'=>['required','string'],
        'phone'=>['required','string',Rule::unique('admins','phone')->ignore($id)],
        'status'=>['required','in:admin,super_admin'],
      ],
      [
       'first_name.required'=>'حقل الاسم الاول مطلوب',
       'first_name.string'=>'يجب ان يكون حقل الاسم الاول نصي',
       'last_name.string'=>'يجب ان يكون حقل الاسم الاخير نصي',
       'email.required'=>'حقل البريد مطلوب',
       'email.email'=>'يجب ان يكون صيغة البريد صحيحه',
       'email.unique'=>'هذا الحساب موجود سابقا',
       'password.required'=>'حقل كلمة السر مطلوب',
       'phone.required'=>'حقل رقم الهاتف مطلوب',
       'phone.unique'=>'هذا الرقم مومود سابقا',
       'status.required'=>'حقل الحالة مطلوب',
       'status.in'=>'يجب تحديد اي من مسؤل او ادارة عليا',
      ]);  

       $checkPassword = Admin::where('id',$id)->first(); 
      if(!Hash::check($request->password,$checkPassword->password)){
        return redirect()->route('admins.view')->with('failed','عفوا كلمة السر خطاء');
      }
      
      Admin::where('id',$id)->update([
        'first_name'=>$request->first_name,
        'last_name'=>$request->last_name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
        'phone'=>$request->phone,
        'status'=>$request->status,
      ]);
      return redirect()->route('admins.view')->with('success','تم تعديل بيانات الحساب بنجاح');
 }   

 // delete admin method
 public function deleteAdmin($id){
    Admin::where('id',$id)->delete();
    return redirect()->route('admins.view')->with('success','تم انشاء حذف بنجاح');
 }


 //get consultion reports view
 public function consultionReport(){
    $highConsultionsOrder = Consultation::select(DB::raw('name'),DB::raw('MAX(order_count) as max_order'))
    ->groupBy('name')
    ->first();
    $getCountBookedThisMonth = Consultion_booking::whereMonth('created_at', Carbon::now()->month)->count();
    $getSuccessCountBooked = Consultion_booking::where('status','success')->count();

    return view('dashboard.reports',compact('highConsultionsOrder','getCountBookedThisMonth','getSuccessCountBooked'));
 }



}
