@extends('layout.layout')
@section('title', $content->title)
@section('extrastyle')
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/articlepage.css')}}">
@endsection
@section('content')
<div class="head">
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-md-6 text-center">
                <h2>{{$content->title}}</h2>
            </div>
            <div class="col-md-6">
                <div class="image">
                    <img src="{{asset($content->getFirstMediaUrl('content'))}}" class="w-100" alt=""> 
                </div>
            </div>
        </div>
    </div>
</div>
<div class="article py-5">
    <div class="container">
        <h2>{{$content->intro}}</h2>
        <div class="date mb-2">
            <i class="fa-solid fa-calendar-days"></i>
            <span>{{$content->created_at->format('Y/m/d')}}</span>
        </div>
        <div class="d-flex major align-items-center">
            <strong>القسم</strong>
            <p>{{$content->service->name}}</p>
        </div>
        <div class="row align-items-center">

                {!! $content->content !!}

            <div class="col-md-12 text-center video">
                <iframe width="500" height="500"
                src="https://www.youtube.com/embed/{{$content->yt_video}}">
                </iframe>
            </div>
        </div>
        
    </div>
</div>

@endsection