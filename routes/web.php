<?php

use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\ConsultationController;
use App\Http\Controllers\Dashboard\ContentController;
use App\Http\Controllers\Dashboard\EditContentController;
use App\Http\Controllers\Dashboard\IndexController;
use App\Http\Controllers\Dashboard\ServiceController;
use App\Http\Controllers\Front\Auth\AuthController as AuthAuthController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\HomeController;
use App\Models\Basic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Start normal user routes
Route::get('/',[HomeController::class,'home'])->name('index');

Route::get('/login',[AuthAuthController::class,'loginView'])
       ->name('login.view');
Route::post('user/login',[AuthAuthController::class,'login'])
       ->name('login');      

Route::get('/register',[AuthAuthController::class,'registerView'])
       ->name('register.view');
Route::post('user/register',[AuthAuthController::class,'register'])
       ->name('register');

Route::get('/register/active',[AuthAuthController::class,'registerActiveView'])
       ->name('register.active.view');

Route::post('user/register/active',[AuthAuthController::class,'registerActive'])
       ->name('register.active'); 
       

Route::get('forget/password',function(){

       return view('auth.forgetpasswrd');

})->name('forget.password.view');

Route::post('forget/password',[AuthAuthController::class,'forgetPasswordMethod'])->name('forget.password');
Route::post('forget/password/check/code',[AuthAuthController::class,'forgetPasswordCheckCodeMethod'])->name('forget.password.check.code');

Route::post('forget/password/update',[AuthAuthController::class,'forgetPasswordUpdateMethod'])->name('forget.password.update');

// Route::get('forget/password/code',function(){

//        return view('auth.fpassword_code');

// })->name('forget.password.code.view');




Route::post('contact/us',[FrontController::class,'contactUs'])
       ->name('contact.us');



Route::get('/about',[FrontController::class,'aboutView'])->name('about');

Route::get('/services',[FrontController::class,'servicesView'])->name('services');

Route::get('/contact',[FrontController::class,'contactView'])->name('contact.view');

Route::get('/privacy-policy', function () {
       $basic = Basic::query()->first();
    return view('privacyandpolicy',compact('basic'));
})->name('privacy-and-policy');

Route::get('/terms-and-conditions', function () {
       $basic = Basic::query()->first();
    return view('termsandcondetions',compact('basic'));
})->name('terms-and-conditions');

Route::get('/return-policy', function () {
       $basic = Basic::query()->first();

    return view('returnpolicy',compact('basic'));
})->name('return-policy');



Route::get('/reservation',[FrontController::class,'reservation'])
       ->name('reservation');

Route::get('/consultationform', function () {
    return view('consultationform');
})->name('consultationform');

Route::get('/userinfo',[FrontController::class,'userinfo'])->name('userinfo');
Route::patch('/userinfo/update',[FrontController::class,'userinfoUpdate'])->name('userinfo.update');


Route::get('/user/consultbooked',[FrontController::class,'userConsultbooked'])->name('consultbooked');

//customers rate
Route::post('home/customer/feedback/create/{consultion_id}',[FrontController::class,'homeCustomerFeedbackUpdate'])
       ->name('home.customer.feedback.create');





// user artical
Route::get('/articles', [FrontController::class,'articals'])->name('articals');
Route::get('/articles/{slug}', [FrontController::class,'show'])->name('articale.show');
Route::get('service/articles/{id}', [FrontController::class,'showServiceArticales'])->name('service.articale.show');


// user consultation
Route::get('/consultation/search', [FrontController::class,'consultationSearch'])->name('consultation.search');

Route::group(['middleware'=>['auth']],function(){

    Route::get('consultation/booking/{consultation_id}/{time_id}',[FrontController::class,'consultationBooking'])
    ->name('consultation.booking');
    Route::post('consultation/booking/create',[FrontController::class,'consultationBookingCreate'])
    ->name('consultation.booking.create');

    // // payment
    Route::get('/payment/{getConsultionTaxPrice}/{consultionBooking_id}',[FrontController::class,'paymentView'])
        ->name('payment.view');
    Route::get('/payment-callback/{id}',[FrontController::class,'updateUserPaymentStatus'])
        ->name('payment.callback');
    
    //logout
    Route::post('logout',[AuthAuthController::class,'logout'])
           ->name('logout');
        
});

// End normal user routes

//******************************************************//
//******************************************************//
//******************************************************//

























































// Start admin dashboard routes
Route::get('admin/login',[AuthController::class,'index']);
Route::post('admin/login',[AuthController::class,'login'])->name('admin.login');

Route::group(['prefix'=>'admin','middleware'=>'auth:admin'],function(){
    Route::get('/index',[IndexController::class,'index'])->name('admin.index');
    Route::post('admin/logout',[IndexController::class,'logout'])->name('admin.logout');
    Route::post('change/password',[IndexController::class,'changePasswordMethod'])->name('admin.change.password');

    // consultation
    Route::resource('consultations',ConsultationController::class);
    Route::put('consultation/update/date/{id}',[ConsultationController::class,'ConsultationUpdateDateMethod'])
           ->name('consultation.update.date');   
    Route::delete('consultation/delete/date/{id}',[ConsultationController::class,'ConsultationDeleteDateMethod'])
           ->name('consultation.delete.date');  

    //consultation add date
    Route::post('consultation/add/date/{id}',[FrontController::class,'consultationAddDate'])
          ->name('consultation.add.date');  

    // consultation date edit
    Route::get('consultation/date/edit/{id}',[FrontController::class,'consultationDateEdit'])
           ->name('consultation.date.edit'); 
    Route::put('consultation/date/times/updateorcreate/{id}',[FrontController::class,'consultationTimesUpdateOrCreate'])
           ->name('consultation.date.times.updateorcreate');   


    //services
    Route::resource('services',ServiceController::class);
    //content
    Route::resource('contents',ContentController::class);
     




// web site content routes
// edit content basic data and viwe
       Route::get('basic/data/edit',[EditContentController::class,'index'])
              ->name('basic.data.view');
       Route::post('basic/data/update',[EditContentController::class,'basicDataUpdate'])
              ->name('basic.data.update');

// edit about content data and viwe
       Route::get('about/data/edit',[EditContentController::class,'aboutView'])
              ->name('about.data.view');
       Route::put('about/data/update/{id}',[EditContentController::class,'aboutDataUpdate'])
              ->name('about.data.update');


// edit all home page content
       Route::get('home/data/edit',[EditContentController::class,'homeView'])
            ->name('home.data.view');
// edit customer rate
       Route::put('customer/rate/update/{id}',[EditContentController::class,'customerRateUpdate'])
              ->name('customer.rate.update');
              
       Route::delete('customer/rate/delete/{id}',[EditContentController::class,'customerRatedelete'])
              ->name('customer.rate.delete');
// governances
       Route::put('home/governances/update/{id}',[EditContentController::class,'homeGovernancesUpdate'])
            ->name('home.governances.update');

// consultation msg
       Route::put('home/consultationmsg/update/{id}',[EditContentController::class,'homeConsultationmsgUpdate'])
            ->name('home.homeconsultationmsg.update');



//privacy
       Route::get('privacy/data/edit', [EditContentController::class,'privacyView'])
              ->name('privacy.data.view');
       Route::put('privacy/data/update/{id}',[EditContentController::class,'privacyDataUpdate'])
              ->name('privacy.data.update');
// terms
       Route::get('terms/data/edit',[EditContentController::class,'termsDataView'])
              ->name('terms.data.view');
       Route::get('terms/data/update/{id}',[EditContentController::class,'termsDataUpdate'])
              ->name('terms.data.update');


       // retrun
       Route::get('return/data/edit',[EditContentController::class,'returnDataView'])
              ->name('return.data.view');
       Route::get('return/data/update/{id}',[EditContentController::class,'returnDataUpdate'])
              ->name('return.data.update');
            

// update consultation booking meeting link for user
       Route::put('consultation/user/update/meeting/link/{id}',[IndexController::class,'consultationUserUpdateMeetingLink'])
             ->name('consultation.user.update.meeting.link');
// update consultation user status after meeting

       Route::put('consultation/user/update/status/{id}',[IndexController::class,'consultationUserUpdateStatus'])
              ->name('consultation.user.update.status');

       Route::delete('consultation/user/delete/consultation/{id}',[IndexController::class,'consultationUserDeleteConsultation'])
              ->name('consultation.user.delete.consultation');
              
// contact messages  
    Route::put('contact/update/{id}',[IndexController::class,'updateContact'])
             ->name('update.contact');             
    Route::delete('contact/delete/{id}',[IndexController::class,'deleteContact'])
           ->name('delete.contact');   




// admin member control
       Route::get('admins',[IndexController::class,'adminView'])->name('admins.view');

       Route::get('add/admin', [IndexController::class,'addAdminView'])->name('add.admin.view');

       Route::post('add/admin', [IndexController::class,'addAdmin'])->name('add.admin');

       Route::get('update/admin/{id}', [IndexController::class,'updateAdminView'])->name('admin.update.view');
       Route::put('update/admin/{id}', [IndexController::class,'updateAdmin'])->name('admin.update');

       Route::delete('delete/admin/{id}', [IndexController::class,'deleteAdmin'])->name('admin.delete');



    Route::get('reports', [IndexController::class,'consultionReport'])->name('reports');
   
    // Route::get('editabout', function () {
    //     return view('dashboard.editcontent.editabout');
    // })->name('editabout');

    // Route::get('editprivacy', function () {
    //     return view('dashboard.editcontent.editprivacy');
    // })->name('editprivacy');

    // Route::get('editterms', function () {
    //     return view('dashboard.editcontent.editterms');
    // })->name('editterms');

    // Route::get('editreturn', function () {
    //     return view('dashboard.editcontent.editreturn');
    // })->name('editreturn');

    // //date time
    // Route::post('add/datetime',[IndexController::class,'datetimeStoreMethod'])->name('admin.datetime.store');
    // Route::delete('date/destroy/{id}',[IndexController::class,'DateDestroyMethod'])->name('admin.date.destroy');
});  
// End admin dashboard routes




