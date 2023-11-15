@extends('layout.layout',['basic'=>$basic])
@section('title','الصفحة الرئيسية')
@section('extrastyle')
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/index.css')}}">
@endsection
@section('content')
@if(Session::get('success'))
<div class="successalert ">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    {{$message = Session::get('success')}}
</div>
@endif
@if(Session::get('failed'))
<div class="erroralert ">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    {{$message = Session::get('failed')}}
</div>
@endif
@error('name')
    <div class="erroralert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{$message}}
    </div>
@enderror
@error('phone')
    <div class="erroralert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{$message}}
    </div>
@enderror
@error('email')
    <div class="erroralert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{$message}}
    </div>
@enderror
@error('subject')
    <div class="erroralert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{$message}}
    </div>
@enderror
@error('content')
    <div class="erroralert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{$message}}
    </div>
@enderror
{{-- start header --}}
<section class="home">
    <div class="container">
        <div class="row content">
            <div class="col-md-6 text-center d-flex flex-column align-items-center">
                <img src="./../../assets/images/new.png" data-aos="flip-left" class="rotating-image w-25" alt="">
                <h1 data-aos="flip-left">{{$basic->name}}</h1>
                <h3 data-aos="fade-up">{{$basic->description}}</h3>
                <span class="line"></span>
                <div class="mb-3">
                    <span class="typing" id="typed"></span>
                </div>
                @guest
                <a href="{{ route('register.view') }}" class="btn btn-darkgold">حساب جديد<i class="fa-solid fa-arrow-left ms-2"></i></a>
                @endguest
                @auth
                <div class="d-flex align-items-center justify-content-center">    
                    <a href="{{ route('reservation') }}" class="btn btn-darkgold mb-2 me-2">استشارة جديدة</a>
                    <a href="" class="btn btn-lightgold mb-2">الإستشارات المحجوزة</a>
                </div>
                @endauth
            </div>
            <div class="col-md-6">
            </div>
        </div>
    </div>
</section>


<section class="about py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5">
                <div class="image">
                    <img src="{{$about->getFirstMediaUrl('about')}}" class="w-100" alt=""> 
                </div>
            </div>
            <div class="col-md-7">
                <h3>من نحن</h3>
                <span>{{$basic->name}} -  {{$basic->description}}</span>
                <div class="line"></div>
                <p>رؤية الأشياء للاستشارات الاستراتيجية والحوكمة هي شركة استشارية رائدة في المملكة العربية السعودية، تأسست عام 2023، وتقدم خدمات لمساعدة الشركات في تطوير الاستراتيجية والحوكمة لقيادة الشركات أو الادارات العليا. تقع الشركة في مدينة جدة، وتضم فريقًا من المستشارين ذوي الخبرة والمهارات المتخصصة في مجال الاستشارات الاستراتيجية والحوكمة و الالتزام.</p>
                <a href="{{ route('about') }}" class="btn btn-darkgold">اقرأ المزيد</a>
                <a href="{{ route('login') }}" class="btn btn-lightgold">التسجيل</a>
            </div>
        </div>
    </div>
</section>


@if ($governances->status == 'active')

    <section class="governance py-5">
        <div class="container">
            <div class="sec-header text-center">
                <h2>الحوكمة</h2>
                <p>{{$governances->section_description}}</p>
            </div>
            <h4 class="text-center">الأهداف</h4>
            <div class="row">
                <div class="col-sm-4 p-2">
                    <div class="goal d-flex flex-column justify-content-start align-items-center h-100 p-3 rounded-2">  
                        <img src="{{asset(env('APP_ASSETS').'/'.'assets/images/document.png')}}" class="w-25 mb-2" alt="">
                        <p>{{$governances->description_one}}</p>
                    </div>
                </div>
                <div class="col-sm-4 p-2">
                    <div class="goal d-flex flex-column justify-content-start align-items-center h-100 p-3 rounded-2">
                        <img src="{{asset(env('APP_ASSETS').'/'.'assets/images/business.png')}}" class="w-25 mb-2" alt="">
                        <p>{{$governances->description_two}}</p>
                    </div>
                </div>
                <div class="col-sm-4 p-2">
                    <div class="goal d-flex flex-column justify-content-start align-items-center h-100 p-3 rounded-2">
                        <img src="{{asset(env('APP_ASSETS').'/'.'assets/images/politician.png')}}" class="w-25 mb-2" alt="">
                        <p>{{$governances->description_three}}</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('services') }}" class="btn btn-dark d-block">كل الخدمات</a>
        </div>
    </section>
    
@endif
<section class="services py-5">
    <div class="container">
        <div class="sec-header text-center">
            <h2>اهم الخدمات</h2>
            <p>تقدم شركة رؤية الأشياء للحوكمة والاستشارات الاستراتيجية العديد من الخدمات التي تخدم قطاء الاعمال والقوانين والضوابط للمؤسسات والشركات.</p>
        </div>
        <div class="row justify-content-center">
             @foreach ($importantServices as $importantService)
             <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="row g-0 align-items-center">
                      <div class="col-5 col-sm-4 p-2">
                        <img src="{{$importantService->getFirstMediaUrl('service')}}" class="img-fluid w-100" alt="card-horizontal-image">
                      </div>
                      <div class="col-7 col-sm-8">
                        <div class="card-body">
                          <h5 class="card-title">{{$importantService->name}}</h5>
                          <p class="card-text">
                            {{$importantService->description}}
                          </p>
                          <a href="" class="btn btn-lightgold d-block">معرفة المزيد</a>
                        </div>
                      </div>
                    </div>
                </div>
            </div>

             @endforeach
            
        </div>
        <a href="{{ route('services') }}" class="btn btn-darkgold main">كل الخدمات</a>
    </div>
</section>
<section class="consultation py-5">
    <div class="container text-center">
        <h3>الاستشارات</h3>
        <p>تقدم شركة رؤية الاشياء خدمة الاستشارات ومساعدة الشركات على تحقيق أهدافها الاستراتيجية من خلال تقديم خدمات استشارية عالية الجودة في مجال الحوكمة والالتزام والاستراتيجيات.</p>
        <a class="btn btn-lightgold" href="{{ route('register.view') }}">التسجيل والاشتراك</a>
        {{-- <a class="btn btn-lightgold" href="{{ route('reservation') }}">حجز استشارة</a> --}}
    </div>
</section>
<section class="lastarticals py-5">
    <div class="container">
        <div class="sec-header text-center">
            <h2>اخر المقالات</h2>
            <p>تقوم شركة رؤية الاشياء بنشر العديد من المقالات الخاصة بمجال الحوكمة وغيرها وفيما يخص الخدمات المقدمة من الشركة.</p>
        </div>
        <div class="row justify-content-center">
            @foreach ($getLastThreeContents as $getLastThreeContent)
                
        
            <div class="col-md-4 col-12 mb-3">
                <div class="card h-100">
                    <img src="{{$getLastThreeContent->getFirstMediaUrl('content')}}" class="w-100" alt="{{$getLastThreeContent->title}}">
                    <div class="content p-2">
                        <h3>{{$getLastThreeContent->title}}</h3>
                        {{-- <strong>{{$getLastThreeContent->title}}</strong> --}}
                        <p class="major">{{$getLastThreeContent->service->name}}</p>
                        <p>
                            {{$getLastThreeContent->intro}}
                        </p>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <div class="date">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>8/10/2023</span>
                        </div>
                        <a href="">قراءة المقال<i class="fa-solid fa-arrow-left ms-1"></i></a>
                    </div>
                </div>
            </div>
           @endforeach
        </div>  
        <a href="{{ route('articals') }}" class="btn btn-lightgold main">كل المقالات</a> 
    </div>
</section>
@if ($getCustomers->count())
    

<section class="testmonials py-5">
    <div class="container text-center">
        <h3>آراء العملاء</h3>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-touch="true">
            {{-- <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div> --}}
            <div class="carousel-inner">
              @foreach ($getCustomers as $getCustomer)
              <div class="carousel-item @if($getCustomer->status=='active') active @endif">
                <div class="d-block w-75 m-auto text-center">
                    <div class="image">
                        <img src="{{$getCustomer->getFirstMediaUrl('customer')}}" class="img-fluid w-100" alt="">
                    </div>
                    <h4>{{$getCustomer->name}}</h4>
                    <h6>{{$getCustomer->job_name}}</h6>
                    <div class="rate d-flex">
                        @php
                            
                            $i=1;
                        @endphp
                        @for ($i; $i<=$getCustomer->rate; $i++)
                        <i class="fa-solid fa-star"></i>
                        @endfor
                       
                    </div>
                    <div class="line"></div>
                    <p>
                    {{$getCustomer->comment}}
                    </p>
                
                    </div>
              </div>
              @endforeach
{{-- 
              <div class="carousel-item">
                <div class="d-block w-75 m-auto text-center">
                    <div class="image">
                        <img src="{{asset(env('APP_ASSETS').'/'.'assets/images/man.png')}}" class="img-fluid w-100" alt="">
                    </div>
                    <h4>د على احمد </h4>
                    <h6>رئيس مجلس ادارة شركة AMNC</h6>
                    <div class="rate d-flex">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <div class="line"></div>
                    <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.
                        إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.</p>
                </div>
              </div>
              <div class="carousel-item">
                <div class="d-block w-75 m-auto text-center">
                    <div class="image">
                        <img src="{{asset(env('APP_ASSETS').'/'.'assets/images/man.png')}}" class="img-fluid w-100" alt="">
                    </div>
                    <h4>د طارق هلال </h4>
                    <h6>رئيس مجلس ادارة شركة AMNC</h6>
                    <div class="rate d-flex">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <div class="line"></div>
                    <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.</p>
                </div>
              </div> --}}
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
@endif
<section class="contact py-5">
    <div class="container">
        <div class="sec-header text-center">
           <h2>تواصل معنا</h2>
           <p>يمكنك التواصل معنا عبر وسائل التواصل الاتية او اترك رسالتك وسنقوم بالتواصل معك</p>
        </div>
        <div class="row align-items-ceter">
            <div class="col-md-4 info">
                <div class="d-flex align-items-center">
                    <div class="icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <p>{{$basic->address}}</p>
                </div>
                <div class="d-flex align-items-center">
                    <div class="icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <p>{{$basic->phone}}</p>
                </div>
                <div class="d-flex align-items-center">
                    <div class="icon">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <p>{{$basic->email}}</p>
                </div>
                @if($basic->whatsapp)
                <div class="d-flex align-items-center">
                    <div class="icon">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <p>{{$basic->whatsapp}}</p>
                </div>
                @endif
            </div>
            <div class="col-md-8">
                <form action="{{route('contact.us')}}" method="POST" id="contactForm" class="bg-black p-3 rounded-3" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" name="name" class="form-control" placeholder="الاسم">
                            <div id="userNameError" class="text-danger"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" name="phone" class="form-control" placeholder="رقم الهاتف">
                            <div id="userPhoneError" class="text-danger"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="email" name="email" class="form-control" placeholder="البريد الالكتروني">
                            <div id="userEmailError" class="text-danger"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" name="subject" class="form-control" placeholder="عنوان الرسالة">
                            <div id="subjectError" class="text-danger"></div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <textarea name="content" id="" class="form-control" placeholder="محتوي الرسالة"></textarea>
                            <div id="messageError" class="text-danger"></div>
                        </div>
                        <div class="col-md-6">
                            <input type="submit" class="btn btn-darkgold" value="ارسال الرسالة">
                        </div>             
                    </div>      
                </form>
            </div>
        </div>
    </div>
</section>


  
@endsection
