@extends('layout.layout')
@section('title','تواصل معنا')
@section('extrastyle')
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/contact.css')}}">
@endsection
@section('content')
@if(Session::get('success'))
    <div class="successalert ">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{$message = Session::get('success')}}
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
                <img src="{{asset(env('APP_ASSETS').'/'.'assets/images/email.png')}}" class="w-25 animate" alt="">
                {{-- <img src="./../../assets/images/new.png" data-aos="flip-left" class="rotating-image w-25" alt=""> --}}
                <h1 data-aos="flip-left">تواصل معنا</h1>
                <span class="line"></span>
                <h3 data-aos="fade-up">قدم مقترح او استفسر عن الخدمات </h3>
                <a href="#contact" class="btn btn-darkgold">التواصل الان<i class="fa-solid fa-arrow-left ms-2"></i></a>
            </div>
            <div class="col-md-6">
            </div>
        </div>
    </div>
</section>
<section id="contact" class="contact py-5">
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