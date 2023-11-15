@extends('layout.layout')
@section('title','الاستشارات المحجوزة')
@section('extrastyle')
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/consultbooked.css')}}">
@endsection
@section('content')
@if(Session::get('success'))
    <div class="successalert ">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{$message = Session::get('success')}}
    </div>
@endif
@if(Session::has('error'))
    <div class="erroralert ">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{$message = Session::get('error')}}
    </div>
@endif

@error('avatar')
<div class="erroralert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    {{$message}}
</div>
@enderror
@error('name')
<div class="erroralert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    {{$message}}
</div>
@enderror
@error('rate')
<div class="erroralert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    {{$message}}
</div>
@enderror
@error('job_name')
<div class="erroralert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    {{$message}}
</div>
@enderror
@error('comment')
<div class="erroralert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    {{$message}}
</div>
@enderror
<section class="booked py-5">
    <div class="container">
        <div class="sec-header text-center">
            <h2>الاستشارات المحجوزة</h2>
            <p>يمكنك الدخول عند بدء موعد الاستشارة حيث تتم الاستشارة عبر المنصات الالكترونية وتبدأ فى الوقت المحدد لها</p>
        </div>
        <table class="w-100">
            <thead>
                <tr>
                    <td>الاستشارة</td>
                    <td>تاريخ حجز الاستشارة</td>
                    <td>وقت الاستشارة</td>
                    <td>الدخول الى الاستشارة</td>
                </tr>
            </thead>
            <tbody>
                @forelse ($getUserConsultionsbooking->consultionsbooking as $UserConsultionbooking)
            
                    
                <tr>
                    <td>{{$UserConsultionbooking->consultion->name}}</td>
                    <td>{{ Carbon\Carbon::parse($UserConsultionbooking->created_at)->format('m/d l ') }}</td>
                    <td>
                        {{Carbon\Carbon::parse($UserConsultionbooking->from_time)->format('g:i A')}}
                        @if($UserConsultionbooking->to_time)
                        الي  {{Carbon\Carbon::parse($UserConsultionbooking->to_time)->format('g:i A')}}
                        @endif
                    </td>
                    <td>
                        @if ($UserConsultionbooking->meeting_link)
                            
                     
                        <a href="{{$UserConsultionbooking->meeting_link}}" target="_blank" class="btn btn-darkgold p-1">
                            الدخول
                            <i class="fa-solid fa-door-open ms-1"></i>
                        </a>
                        @else
                       الرابط غير متوفر الان
                        @endif
                    </td>
                </tr>
              
                @empty
                <tr>
                    <td colspan="4" style="border-radius: 30px !important"><h4>لا يوجد استشارات محجوزة حتي الان</h4></td>
                </tr>
                @endforelse 

            </tbody>
        </table>
    </div>    
</section>
<section class="completed py-5">
    <div class="container">
        <div class="sec-header text-center">
            <h2>استشارات سابقة</h2>
            <p>يمكنك تقييم استشاراتك السابقة وتقديم ملحوظاتك عن الخدمة لعرضها فى اراء العملاء ومساعدتنا فى تحسين الخدمات الخاصة بنا</p>
        </div>
        <table class="w-100">
            <thead>
                <tr>
                    <td>الاستشارة</td>
                    <td>تاريخ حجز الاستشارة</td>
                    <td>تقييم الاستشارة</td>
                </tr>
            </thead>
            <tbody>
                @forelse ($getUserSuccessConsultionsbookinged->consultionsbooking as $UserSuccessConsultionbookinged)
                <tr>
                    <td>{{$UserSuccessConsultionbookinged->consultion->name}}</td>
                    <td>{{ Carbon\Carbon::parse($UserSuccessConsultionbookinged->created_at)->format('m/d l ') }}</td>
                    <td>
                        <button type="button" class="btn btn-success p-1 rate-btn">
                            التقييم
                            <i class="fa-solid fa-star-half-stroke ms-1"></i>
                        </button>
                        <div class="rate">
                            <div class="box-rate">
                                <i class="fa-solid fa-xmark close-btn" onclick="hideRate()"></i>
                                <h3>التقييم والتعليق</h3>
                                <p>
                                    أسم الاستشارة : {{$UserSuccessConsultionbookinged->consultion->name}}
                                </p>
                                <form action="{{route('home.customer.feedback.create',$UserSuccessConsultionbookinged->consultion->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <label for="">الصورة الشخصية</label>
                                    <input type="file" name="avatar" class="form-control mb-2">
                
                                    <label for="name">الأسم</label>
                                    <input type="text" name="name" class="form-control mb-2" placeholder="اسم الشخص">
                
                                    <label for="job_name">المسمي الوظيفي</label>
                                    <input type="text" name="job_name" id="job_name" class="form-control mb-2" placeholder="مدير شركة ...">
                
                                    <label for="rate">التقييم<i class="fa-solid fa-star-half-stroke ms-1"></i></label>
                                    <select name="rate" id="rate" class="form-control mb-2">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                
                                    <label for="comment">التعليق</label>
                                    <textarea name="comment" id="comment" class="form-control mb-2"></textarea>
                                    <button  class="btn btn-darkgold">التقييم الآن</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3"  style="border-radius: 30px !important"><h4>لا يوجد استشارات سابقة حتي الان</h4></td>
                </tr>
                @endforelse 
            </tbody>
        </table>
        
    </div>
</section>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const rateBtns = document.querySelectorAll(".rate-btn");
        const closeBtn = document.querySelector(".close-btn");

        rateBtns.forEach(function(btn) {
            btn.addEventListener("click", function() {
                document.querySelector('.rate').style.display = 'flex';
            });
        });
    });
    function hideRate() {
        var rateDiv = document.querySelector('.rate');
        rateDiv.style.display = 'none';
    }
</script>


@endsection