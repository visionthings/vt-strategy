@extends('layout.layout')
@section('title','المقالات')
@section('extrastyle')
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/articals.css')}}">
@endsection
@section('content')
<div class="home">
    <div class="container position-relative z-3">
        <div class="row">
            <div class="col-md-5 text-center">
                <img src="{{asset(env('APP_ASSETS').'/'.'assets/images/website.png')}}" class="w-25 animate" alt="المقالات">
                {{-- <i class="fa fa-pencil animate"></i> --}}
                <h2>المقالات</h2>
                <div class="line"></div>
                <p>يمكنك قراءة بعض المقالات التي يمكنها الجواب على بعض التساؤلات التي تبحث عنها</p>
                <a class="btn btn-darkgold" href="#articals">قراءة المقالات<i class="fa fa-eye ms-2"></i></a>
            </div>
            <div class="col-md-7"></div>
        </div>
    </div>
</div>
<div class="articals py-5" id="articals">
    <div class="container">
        <div class="sec-header text-center">
            <h2>المقالات</h2>
            <p>يمكنك معرفة المزيد من المعلومات وكل ما هو جديد لدينا</p>
        </div>
        <div class="row justify-content-center">
            @foreach ($contents as $content)
                <div class="col-md-4 col-sm-6 col-12 mb-3">
                    <div class="card h-100">
                        <img src="{{$content->getFirstMediaUrl('content')}}" class="w-100" alt="">
                        <div class="content p-2">
                            <h3>{{$content->title}}</h3>
                            <strong>القسم</strong>
                            <p class="major">{{$content->service->name}}</p>
                            <p>
                                {{$content->intro}}
                            </p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <div class="date">
                                <i class="fa-solid fa-calendar-days"></i>
                                <span>{{$content->created_at->format('Y/m/d')}}</span>
                            </div>
                            <a href="{{route('articale.show',$content->slug)}}">قراءة المقال<i class="fa-solid fa-arrow-left ms-1"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- start pagination --}}
        {{-- <div aria-label="Page navigation">
            <ul class="pagination d-flex justify-content-center mt-3">
              <li class="page-item ">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">السابق</a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item active" aria-current="page">
                <a class="page-link" href="#">2</a>
              </li>
              <li class="page-item"><a class="page-link" href="#">...</a></li>
              <li class="page-item"><a class="page-link" href="#">9</a></li>
              <li class="page-item">
                <a class="page-link" href="#">التالى</a>
              </li>
            </ul>
        </div> --}}


    </div>
   {{$contents->links()}}
</div>

@endsection