@extends('layout.layout')
@section('title','الاستشارات')
@section('extrastyle')
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/reservation.css')}}">
@endsection
@section('content')
{{-- start header --}}
<section class="home">
    <div class="container">
        <div class="row content">
            <div class="col-md-6 text-center d-flex flex-column align-items-center">
                <img src="{{asset(env('APP_ASSETS').'/'.'assets/images/conversation.png')}}" class="w-25 animate" alt="">
                <h1 data-aos="flip-left">احجز استشارة جديدة</h1>
                <span class="line"></span>
                <h3 data-aos="fade-up">يمكنك تسجيل موعد استشارة الان للحصول على خدماتنا</h3>
                <a href="#booknow" class="btn btn-darkgold">الحجز<i class="fa-solid fa-arrow-left ms-2"></i></a>
            </div>
            <div class="col-md-6">
            </div>
        </div>
    </div>
</section>

<section class="reservation py-5" id="booknow">
    <div class="container">
        <div class="sec-header text-center">
            <h2>احجز استشارتك الان</h2>
            <p>اذا كنت تريد الحصول على احد خدماتنا او استشارة فى مجالات الحوكمة يمكنك حجز الان معنا</p>
        </div>

       <div class="con-searsh-container">
        <div class="con-searsh-content">
            {{-- <h5>ابحث عن الاستشارة</h5>
            <form id="multiStepForm" method="GET" action="{{route('consultation.search')}}">
                <input type="text" name="consultation_name" class="form-control" placeholder="  أســم الاسـتـشـــارة">
                <button type="submit" class="btn btn-darkgold ms-2">بحث</button>
            </form> --}}
            {{-- <h3 class="mt-3">استشارات سريعة</h3> --}}
            <h4>اختر الاستشارة واحجز الان</h4>
            <div class="fastserch d-flex align-items-center flex-wrap justify-content-center">
                @foreach ($consultions as $consultion)
                  <a href="/consultation/search?consultation_name={{$consultion->name}}" class="btn btn-lightgold m-2">{{$consultion->name}}</a>
                @endforeach
                
            </div>
        </div>
       </div>


        {{-- <div class="row  align-items-center">
            <div class="col-md-7 p-3">
                <form id="multiStepForm" class="w-100" method="POST" action="">
                    <div class="step active" id="step1">
                        <h3>بيانات الحجز</h3>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" name="name" placeholder="الاسم"  required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="email" class="form-control" name="name" placeholder="البريد الالكتروني"  required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="tel" class="form-control" name="name" placeholder="رقم الهاتف"  required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <select name="time" class="form-control" id="" required>
                                    <option value="" selected disabled>موعد الاستشارة</option>
                                    <option value="">...</option>
                                    <option value="">...</option>
                                    <option value="">...</option>
                                    <option value="">...</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3 text-end">
                                <button type="button" class="btm btn-darkgold" onclick="nextStep('step1', 'step2')">التالى</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="step" id="step2">
                        <h3>الخصم</h3>
                        <p>اذا كان لديك برومو خصم يمكنك ان تستخدمه الان</p>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <form action="" id="promoform">
                                    <input type="text" class="form-control mb-2" name="promo" placeholder="ادخل كود الخصم">
                                    <button type="button" class="btn btn-darkgold">تطبيق الكود</button>
                                </form>
                                
                            </div>
                            <div class="col-md-12 d-flex justify-content-between mb-3">
                                <button type="button" class="btn btn-lightgold" onclick="prevStep('step2', 'step1')">السابق</button>
                                <button type="button" class="btn btn-darkgold" onclick="nextStep('step2', 'step3')">التالى</button>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="step" id="step3">
                        <h3>طريقة الدفع</h3>
                        <div class="row">
                            <div class="col-4 mb-3">
                                <div class="radio-container">
                                    <input type="radio" id="visa" class="radio-button" name="payment">
                                    <label for="visa" class="radio-label">
                                        <img src="{{asset(env('APP_ASSETS').'/'.'assets/images/visa.png')}}" class="w-100" alt="">
                                    </label>
                                </div>
                            </div>
                            <div class="col-4 mb-3">
                                <div class="radio-container">
                                    <input type="radio" id="paypal" class="radio-button" name="payment">
                                    <label for="paypal" class="radio-label">
                                        <img src="{{asset(env('APP_ASSETS').'/'.'assets/images/paypal.png')}}" class="w-100" alt="">
                                    </label>
                                </div>
                            </div>
                            <div class="col-4 mb-3">
                                <div class="radio-container">
                                    <input type="radio" id="applepay" class="radio-button" name="payment">
                                    <label for="applepay" class="radio-label">
                                        <img src="{{asset(env('APP_ASSETS').'/'.'assets/images/apple-pay.png')}}" class="w-100" alt="">
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex justify-content-between mb-3">
                                <button type="button" class="btn btn-lightgold" onclick="prevStep('step3', 'step2')">السابق</button>
                                <button type="submit" class="btn btn-darkgold">الدفع والحجز</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="col-md-5 bg-black rounded-3 text-center pricing">
                <h3>السعر الاجمالى</h3>
                <table class="w-100">
                    <tr>
                        <td>السعر</td>
                        <td>50</td>
                    </tr>
                    <tr class="light">
                        <td>الضريبة 15% </td>
                        <td>7.5</td>
                    </tr>
                    <tr>
                        <td>الخصم</td>
                        <td>0</td>
                    </tr>
                    <tr class="">
                        <td colspan="2"><div class="line"></div></td>
                    </tr>
                    <tr>
                        <td>الإجمالى</td>
                        <td><strong class="me-3">57.5</strong><span>ريال سعودي</span></td>
                    </tr>
                </table>
            </div>
        </div> --}}
       
    
    </div>
</section>
<script>
    function nextStep(currentStepId, nextStepId) {
        document.getElementById(currentStepId).classList.remove("active");
        document.getElementById(nextStepId).classList.add("active");
    }

    function prevStep(currentStepId, prevStepId) {
        document.getElementById(currentStepId).classList.remove("active");
        document.getElementById(prevStepId).classList.add("active");
    }
</script>
@endsection