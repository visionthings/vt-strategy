@extends('layout.layout')
@section('title','من نحن')
@section('extrastyle')
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/about.css')}}">
@endsection
@section('content')
{{-- start header --}}
<section class="home">
    <div class="container">
        <div class="row content">
            <div class="col-md-6 text-center d-flex flex-column align-items-center">
                <img src="./../../assets/images/new.png" data-aos="flip-left" class="rotating-image w-25" alt="">
                <h1 data-aos="flip-left">من نحن</h1>
                <span class="line"></span>
                <h3 data-aos="fade-up">رؤية الأشياء للاستشارات الاستراتيجية والحوكمة</h3>
                <a href="{{ route('register.view') }}" class="btn btn-darkgold">حساب جديد<i class="fa-solid fa-arrow-left ms-2"></i></a>
                {{-- <a href="{{route ('reservation')}}" class="btn btn-darkgold">حجز استشارة جديدة<i class="fa-solid fa-arrow-left ms-2"></i></a> --}}
            </div>
            <div class="col-md-6">
            </div>
        </div>
    </div>
</section>
<section class="about py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7">
                <h3>من نحن</h3>
                <span>{{$about->short_text}}</span>
                <div class="line"></div>
                <p>{!!$about->content !!}<span>مهندس هتان عاشور</span>.</p>
                <a href="{{ route('services') }}" class="btn btn-darkgold">خدماتــنــا</a>
                <a href="{{ route('login') }}" class="btn btn-lightgold">التسجيل</a>
            </div>
            <div class="col-md-5">
                <div class="image">
                    <img src="{{$about->getFirstMediaUrl('about')}}" class="img-fluid w-100" alt="مهندس هتان حسن عاشور"> 
                </div>
            </div>
        </div>
    </div>
</section>
<section class="goals py-5">
    <div class="container">
        <div class="sec-header">
            <h2>مهمتنا</h2>
            <p>قيمنا مساعدة الشركات على تحقيق أهدافها الاستراتيجية من خلال تقديم خدمات استشارية عالية الجودة في مجال الحوكمة والالتزام والاستراتيجيات.</p>
        </div>
        <div class="row align-items-stretch">
            <div class="col-md-4 p-2 mb-3">
                <div class="goal p-3 text-center rounded-3">
                    <img src="{{asset(env('APP_ASSETS').'/'.'assets/images/integration.png')}}" class="w-50" alt="النزاهة">
                    <h3 class="goal-1">النزاهة</h3>
                    <p>نلتزم بالمعايير الأخلاقية العالية في جميع جوانب عملنا.</p>
                </div>
            </div>
            <div class="col-md-4 p-2 mb-3">
                <div class="goal p-3 text-center rounded-3">
                    <img src="{{asset(env('APP_ASSETS').'/'.'assets/images/technology.png')}}" class="w-50" alt="الابتكار">
                    <h3 class="goal-2">الابتكار</h3>
                    <p>نسعى باستمرار إلى تطوير حلول جديدة ومبتكرة لمساعدة عملائنا.</p>
                </div>
            </div>
            <div class="col-md-4 p-2 mb-3">
                <div class="goal p-3 text-center rounded-3">
                    <img src="{{asset(env('APP_ASSETS').'/'.'assets/images/partnership.png')}}" class="w-50" alt="الشراكة">
                    <h3 class="goal-3">الشراكة</h3>
                    <p>نعمل مع عملائنا كشركاء لضمان نجاحهم.</p>
                </div>
            </div>
        </div>        
    </div>
</section>
<section class="customers py-5">
    <div class="container">
        <div class="sec-header text-center">
            <h2>عملاءنا المحتملون</h2>
            <p>تقدم رؤية الأشياء للاستشارات الاستراتيجية والحوكمة خدماتها لأنواع مختلفة من الشركات، بما في ذلك:</p>
        </div>
        <div class="row">
            <div class="customer col-md-4 p-3 text-center">
                <div class="circle circle-1">
                    <img src="{{asset(env('APP_ASSETS').'/'.'assets/images/office-building.png')}}" class="w-50" alt="الشركات الصغيرة">
                </div>
                <h6 class="custom-1">الشركات الكبيرة والصغيرة والمتوسطة</h6>
            </div>
            <div class="customer col-md-4 p-3 text-center">
                <div class="circle circle-2">
                    <img src="{{asset(env('APP_ASSETS').'/'.'assets/images/shares.png')}}" class="w-50" alt="الشركات المساهمة">
                </div>
                <h6 class="custom-2">الشركات المساهمة المغلقة أو المدرجة في السوق</h6>
            </div>
            <div class="customer col-md-4 p-3 text-center">
                <div class="circle circle-3">
                    <img src="{{asset(env('APP_ASSETS').'/'.'assets/images/city.png')}}" class="w-50" alt="شركات المملكة العربية السعودية">
                </div>
                <h6 class="custom-3">الشركات الدولية العاملة في المملكة العربية السعودية</h6>
            </div>
        </div>
        
    </div>
</section>
@endsection