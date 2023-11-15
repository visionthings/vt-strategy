@extends('layout.layout')
@section('title',$consultation->name)
@section('extrastyle')
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/booking.css')}}">
@endsection
@section('content')
<div class="booking py-5">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5 mb-3">
                <div class="box p-3">
                    <ul>
                        <li class="text-center head">
                            الاستشارة : <span>{{ $consultation->name }}</span>
                        </li>
                        <li>
                            <div class="icon">
                                <i class="fa-solid fa-dollar-sign"></i>
                            </div>
                             <span> السعر <strong>{{ $consultation->price }}</strong> ريال سعودي </span>  
                        </li>
                    @if ($consultation->tax)
                        <li>
                            <div class="icon">
                                <i class="fa-solid fa-calculator"></i>
                            </div>
                            
                        <span>ضريبة القيمة المضافة ( {{ $consultation->tax}}% )</span>    
                        </li>
                        <li>
                            <div class="icon">
                                <i class="fa-solid fa-hand-holding-dollar"></i>
                            </div>
                            <span>الإجمالى بعد الضريبة : <strong>{{$consultation->tax_price}}</strong> ريال سعودي</span>  
    
                        </li>
                    @endif
                    
                    </ul>
                </div>
            </div>
            <div class="col-md-7">
                <div class="box p-3 text-center form-box">
                    <form action="{{route('consultation.booking.create')}}" class="w-75 m-auto" method="POST">
                
                        @csrf
                        <div>
                            <input type="hidden" name="consultion_id" value="{{$consultation->id}}">
                        </div>
                        <div>
                            <input type="hidden" name="time_id" value="{{$time->id}}">
                        </div>
                        
                        <div>
                            <h5 class="mb-3">الاستشارة : <span>{{$consultation->name}}</span></h5>
                            <p class="mb-1 time-head">
                                الوقت المحدد 
                                <p class="time">
                                    {{Carbon\Carbon::parse($time->from_time)->format('g:i A')}}
                                    @if($time->to_time) 
                                    <span class="to-text">الي</span> 
                                    {{Carbon\Carbon::parse($time->to_time)->format('g:i A')}}
                                    @endif
                                </p>
                               
                            </p>
                        </div>
        
                        <div>
                            @error('name')
                                  <p class="alert alert-danger">{{$message}}</p>  
                            @enderror
                            <input type="text" name="name" class="form-control mb-2" placeholder="الاسم" value="{{Auth::user()->name}}" required>
                        </div>
                        <div>
                            @error('phone')
                                 <p class="alert alert-danger">{{$message}}</p>  
                            @enderror
                            <input type="text" name="phone" class="form-control mb-2" placeholder="رقم الهاتف" value="{{Auth::user()->phone}}" required>
                        </div>
                        <div>
                            @error('email')
                                 <p class="alert alert-danger">{{$message}}</p>  
                            @enderror
                            <input type="email" name="email" class="form-control mb-2" placeholder="البريد الالكتروني" value="{{Auth::user()->email}}" required> 
                        </div>
                        <div>
                            <button class="btn btn-darkgold">حجز الان</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


  {{-- <div class="consultation-booking-container">
    <div class="consultation-booking-content">

        <div class="consultation-booking-info">
            <ul>
                    <li>
                        أسم الاستشارة : {{ $consultation->name }}
                    </li>
                    <li>
                       السعر <strong>{{ $consultation->price }}</strong> ريال سعودي   
                    </li>
                @if ($consultation->tax)
                    <li>
                        ضريبة القيمة المضافة ( {{ $consultation->tax}}% )
                    </li>
                    <li>
                        الإجمالى بعد الضريبة : <strong>{{$consultation->tax_price}}</strong> ريال سعودي

                    </li>
                @endif
                
            </ul>
        </div>

        <div class="consultation-booking-form">
            <form action="{{route('consultation.booking.create')}}" method="POST">
                
                @csrf
                <div>
                    <input type="hidden" name="consultion_id" value="{{$consultation->id}}">
                </div>
                <div>
                    <input type="hidden" name="time_id" value="{{$time->id}}">
                </div>
                
                <div>
                    <h5>أسم الاستشارة : {{$consultation->name}}</h5>
                    <p>
                        الوقت المحدد 
                        <p>
                            {{Carbon\Carbon::parse($time->from_time)->format('g:i A')}}
                            @if($time->to_time) 
                            <span class="to-text">الي</span> 
                            {{Carbon\Carbon::parse($time->to_time)->format('g:i A')}}
                            @endif
                        </p>
                       
                    </p>
                </div>

                <div>
                    @error('name')
                          <p class="alert alert-danger">{{$message}}</p>  
                    @enderror
                    <input type="text" name="name" placeholder="الاسم" value="{{Auth::user()->name}}" required>
                </div>
                <div>
                    @error('phone')
                         <p class="alert alert-danger">{{$message}}</p>  
                    @enderror
                    <input type="text" name="phone" placeholder="رقم الهاتف" value="{{Auth::user()->phone}}" required>
                </div>
                <div>
                    @error('email')
                         <p class="alert alert-danger">{{$message}}</p>  
                    @enderror
                    <input type="email" name="email" placeholder="البريد الالكتروني" value="{{Auth::user()->email}}" required> 
                </div>
                <div>
                    <button class="btn btn-darkgold">حجز الان</button>
                </div>
            </form>
        </div>

    </div>
  </div> --}}
@endsection
