@extends('layout.layout')
@section('title','الخدمات')
@section('extrastyle')
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/services.css')}}">
@endsection
@section('content')
{{-- start header --}}
<section class="home">
    <div class="container">
        <div class="row content">
            <div class="col-md-6 text-center d-flex flex-column align-items-center">
                <img src="{{asset(env('APP_ASSETS').'/'.'assets/images/customer-service.png')}}" class="w-25 animate" alt="">
                {{-- <img src="./../../assets/images/new.png" data-aos="flip-left" class="rotating-image w-25" alt=""> --}}
                <h1 data-aos="flip-left">الخدمات</h1>
                <span class="line"></span>
                <h3 data-aos="fade-up">تقدم رؤية الاشياء العديد من الخدمات الخاصة بالحوكمة والاستشارات الاستراتيجية</h3>
                <a href="#services" class="btn btn-darkgold">المزيد<i class="fa-solid fa-arrow-left ms-2"></i></a>
            </div>
            <div class="col-md-6">
            </div>
        </div>
    </div>
</section>
<section id="services" class="services py-5">
    <div class="container">
        <div class="sec-header text-center">
            <h2>الخدمات</h2>
            <p>تقدم رؤية الأشياء للاستشارات الاستراتيجية والحوكمة مجموعة متنوعة من الخدمات الاستشارية في مجال الحوكمة والالتزام والاستراتيجيات، بما في ذلك:</p>
        </div>
        <div class="row justify-content-center">
            @foreach ($services as $service)
                
       
            <div class="col-md-4 .col-sm-6 p-2 mb-2">
                <div class="serv">
                    <div class="circle">
                        <img src="{{$service->getFirstMediaUrl('service')}}" class="img-fluid h-100" alt="الشركات الصغيرة">
                    </div>
                    <h6> {{$service->name}}</h6>
                    <div class="overlay d-flex flex-column justify-content-center align-items-center">
                        <button type="button" class="btn btn-lightgold showdetail mb-2"><i class="fa-brands fa-readme me-2"></i>تفاصيل الخدمة</button>
                        <a href="{{route('service.articale.show',$service->id)}}" class="btn btn-darkgold"><i class="fa-brands fa-readme me-2"></i>مقالات الخدمة</a>
                    </div>
                    <div class="details">
                        <div class="content">
                            <button class="closebtn btn btn-warning"><i class="fa-solid fa-xmark"></i></button>
                            <div>
                               {{$service->description}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
           
        </div>
       {{$services->links()}}

    </div>
</section>
<script>

function showDetails(btn) {
    var parentServ = btn.closest(".serv");
    var details = parentServ.querySelector(".details");
    details.style.display = "flex";
}

function hideDetails(btn) {
    var parentServ = btn.closest(".serv");
    var details = parentServ.querySelector(".details");
    details.style.display = "none"; 
}

var showDetailBtns = document.querySelectorAll(".showdetail");
var closeIcons = document.querySelectorAll(".closebtn");

showDetailBtns.forEach(function(btn) {
    btn.addEventListener("click", function() {
        showDetails(btn);
    });
});

closeIcons.forEach(function(icon) {
    icon.addEventListener("click", function() {
        hideDetails(icon);
    });
});


</script>

@endsection