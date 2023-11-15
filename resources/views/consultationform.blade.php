@extends('layout.layout')
@section('title','الاستشارات')
@section('extrastyle')
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/reservation.css')}}">
@endsection
@section('content')


<section class="reservation py-5" id="booknow">
    <div class="container">
        <div class="sec-header text-center">
            <h2>احجز استشارتك الان</h2>
            <p>اذا كنت تريد الحصول على احد خدماتنا او استشارة فى مجالات الحوكمة يمكنك حجز الان معنا</p>
        </div>

        <div class="row  align-items-center">
            <div class="col-md-7 p-3">
                <form id="multiStepForm" class="w-100" method="POST" action="">
                    <div class="text-center">
                        <h6>حجز استشارة: <span>اسم الاستشارة</span></h6>
                        <h6>تاريخ الاستشارة: <span>11/11/2023</span></h6>
                    </div>
                    <div class="step active" id="step1">
                        <h3>بيانات الحجز</h3>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="username">الأسم بالكامل</label>
                                <input type="text" id="username" class="form-control" name="name" placeholder="الاسم"  required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="useremail">البريد الالكتروني</label>
                                <input type="email" id="useremail" class="form-control" name="name" placeholder="البريد الالكتروني"  required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="userphone">رقم الهاتف</label>
                                <input type="tel" class="form-control" id="userphone" name="name" placeholder="رقم الهاتف"  required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="userwhatsapp">رقم هاتف واتساب</label>
                                <input type="tel" id="userwhatsapp" class="form-control" name="name" placeholder="رقم الهاتف"  required>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="time">موعد الإستشارة</label>
                                <select name="time" class="form-control" id="time" required>
                                    <option value="" selected disabled>موعد الاستشارة</option>
                                    <option value="">...</option>
                                    <option value="">...</option>
                                    <option value="">...</option>
                                    <option value="">...</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3 text-end">
                                <button type="button" class="btm btn-darkgold" onclick="nextStep('step1', 'step3')">التالى</button>
                            </div>
                        </div>
                    </div>
                    
                    {{-- <div class="step" id="step2">
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
                    </div> --}}
                    
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
                                <button type="button" class="btn btn-lightgold" onclick="prevStep('step3', 'step1')">السابق</button>
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
        </div>
       
    
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