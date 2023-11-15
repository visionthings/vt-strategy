@extends('layout.layout')
@section('title', 'نتائج البحث')
@section('extrastyle')
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/consultsearch.css')}}">
@endsection
@section('content')
    <section class="cons py-5">
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($consultationsResult as $consultations)
                <div class="col-md-6 mb-3">
                    <div class="card text-center p-3 h-100">
                        <div class="row align-items-center h-100">
                            <div class="col-6">
                                <h6>الاستشارة <span>{{ $consultations->name }}</span></h6>
                                <p>السعر <strong>{{ $consultations->price }}</strong><span class="ms-2 currancy">ريال سعودي</span></p>
                                <p>ضريبة القيمة المضافة <span>
                                    @if ($consultations->tax)
                                    ( {{$consultations->tax}}% )<i class="fa-solid fa-square-check text-success"></i>
                                    @else
                                    <i class="fa-solid fa-square-xmark text-danger"></i>
                                    @endif
                                </span>
                                </p>
                                @if ($consultations->tax)
                                <p class="total">
                                    الإجمالى بعد  الضريبة : 
                                    <strong>
                                        {{ $consultations->tax_price }}
                                    </strong>
                                    <span class="ms-2 currancy">
                                        ريال سعودي
                                    </span>
                        
                                </p>
                                @endif
                            </div>

                            <div class="col-6 p-0 pe-4">
                                <table class="w-100">
                                    @foreach ($consultations->dates as $date)
                                    <tbody>
                                        @if ($date->times->count())
                                            <tr>
                                                <td colspan="3"><h6 class="date m-0">{{ Carbon\Carbon::parse($date->date)->format('m/d l ') }}</h6></td>
                                            </tr>
                                            @foreach ($date->times as $time)
                                            <tr>
                                                <td>
                                                    <a href="{{route('consultation.booking',[$consultations->id,$time->id])}}">
                                                        {{Carbon\Carbon::parse($time->from_time)->format('g:i A')}}
                                                        @if($time->to_time)
                                                        <strong class="ms-1 me-1 text-dark">الى</strong>
                                                        {{Carbon\Carbon::parse($time->to_time)->format('g:i A')}}
                                                        @endif
                                                    </a>
                                                   
                                                </td>
                                             
                                                
                                            </tr>
                                            @endforeach
                                         @endif
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div> 
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- <div class="consultation-search-result-container">
        <div class="consultation-search-result-content container">
            <div class="consultation-search-result row">
                @foreach ($consultationsResult as $consultations)
                    <div class="consultation-search-result-data col-md-6">
                        <div>
                            <ul>
                                <li>
                                    أسم الاستشارة : {{ $consultations->name }}
                                </li>
                                <li>
                                    سعر الاستشارة قبل الضريبه: {{ $consultations->price }}
                                </li>
                                @if ($consultations->tax)
                                <li>
                                    سعر الاستشارة بعد الضريبه: {{ $consultations->tax_price }}
                                </li>
                                @endif
                            </ul>
                        </div>
                        <div>
                            <ul class="consultation-date-time-list-items">
                                @foreach ($consultations->dates as $date)
                                    <li class="consultation-date-time-item">
                                        <div class="consultation-date-time-container">
                                            <div class="consultation-date-time-content">
                                                <div class="consultation-date-time-body">
                                                    @if ($date->times->count())
                                                        <ul>
                                                            <div class="consultation-date-time-header">
                                                                <p>{{ Carbon\Carbon::parse($date->date)->format('m/d l ') }}
                                                                </p>
                                                            </div>
                                                            @foreach ($date->times as $time)
                                                                <a href="{{route('consultation.booking',[$consultations->id,$time->id])}}">
                                                                    <li>
                                                                        <div class="from-and-to-time-container">
                                                                            <p>
                                                                                <b>من</b> 
                                                                                {{Carbon\Carbon::parse($time->from_time)->format('g:i A')}}
                                                                            </p>
                                                                            <p>
                                                                                @if ($time->to_time)
                                                                                    <b>الي</b> 
                                                                                    {{Carbon\Carbon::parse($time->to_time)->format('g:i A')}}
                                                                                @endif
                                                                            </p>
                                                                        </div>
                                                                    </li>
                                                                </a>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div> --}}

@endsection
