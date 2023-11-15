<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/fontawesome/css/all.min.css')}}" />
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/bootstrap.rtl.css')}}" />
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/mainstyle.css')}}" />
    <link rel="icon" href="{{asset(env('APP_ASSETS').'/'.'assets/images/new.png')}}" type="image/png">
    <meta name="description" content="شركة تقدم خدمات استشارات قانونية للشركات والأفراد في المملكة العربية السعودية الخاصة بالحوكمة وتقديم مقالات الخاصة التي توضح هذه الخدمات واهميتها للشركات.">
    <meta name="keywords" content="استشارات قانونية، شركات، أفراد، المملكة العربية السعودية، القانون، الاستشارات الاستراتيجية،الحوكمة،استشارات الحوكمة">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="رؤية الاشياء للاستشارات الاستراتيجية">
    <meta property="og:description" content=" شركة تقدم خدمات استشارات قانونية والحوكمة للشركات والأفراد في المملكة العربية السعودية.">
    <meta property="og:image" content="{{asset(env('APP_ASSETS').'/'.'assets/images/new.png')}}">
    <meta property="og:url" content="https://vtstrategy.org/">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="رؤية الاشياء للاستشارات الاستراتيجية">
    <meta property="twitter:description" content="شركة تقدم خدمات استشارات قانونية والحوكمة للشركات والأفراد في المملكة العربية السعودية.">
    <meta property="twitter:image" content="{{asset(env('APP_ASSETS').'/'.'assets/images/new.png')}}">
    
    @yield('extrastyle')
    <title>@yield('title','Unknow')</title>
</head>
<body>
    @if(Session::get('login'))
    <div class="successalert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
         {{$message = Session::get('login')}}
    </div>
    @endif 
    @if(Session::get('register'))
    <div class="successalert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
         {{$message = Session::get('register')}}
    </div>
    @endif 
    @if(Session::get('logout'))
    <div class="successalert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
         {{$message = Session::get('logout')}}
    </div>
    @endif 
   
  {{-- start navbar --}}
    <nav class="navbar navbar-expand-md" id="mainNavbar">
        <div class="container">
          <a class="navbar-brand" routerLink="/home"><img src="{{$basic->getFirstMediaUrl('logo')}}" alt="{{$basic->description}}" width="150px"/></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-solid fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto mb-2 mb-lg-0">
              <li class="nav-item {{ Request::is('/') ? 'activeli' : '' }}">
                <a class="nav-link" href="{{ route('index') }}">الرئيسية</a>
              </li>
              <li class="nav-item {{ Request::is('about') ? 'activeli' : '' }}">
                  <a class="nav-link" href="{{ route('about') }}">من نحن</a>
              </li>
              <li class="nav-item {{ Request::is('services') ? 'activeli' : '' }}">
                  <a class="nav-link" href="{{ route('services') }}">الخدمات</a>
              </li>
              <li class="nav-item {{ Request::is('reservation') ? 'activeli' : '' }}">
                  <a class="nav-link" href="{{ route('reservation') }}"> الاستشارات</a>
              </li>
              <li class="nav-item {{ Request::is('articals') ? 'activeli' : '' }}">
                  <a class="nav-link" href="{{ route('articals') }}">المقالات</a>
              </li>
              <li class="nav-item {{ Request::is('contact.view') ? 'activeli' : '' }}">
                  <a class="nav-link" href="{{ route('contact.view') }}">تواصل معنا</a>
              </li>
              @auth
              <li class="nav-item dropdown d-md-flex align-items-center">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user"></i> 
                    <span>{{Auth::user()->name}}</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="{{route('userinfo')}}">تعديل البيانات الشخصية</a></li>
                  <li><a class="dropdown-item" href="{{route('consultbooked')}}">الاستشارات المحجوزة</a></li>
                  <li><form action="{{route('logout')}}" method="POST">
                    @csrf
                  <button class="logbtn">تسجيل الخروج</button>
                 </form></li>
                </ul>
              </li>
              @endauth
            </ul>
            @auth
              {{-- <div class="d-flex align-items-center justify-content-center">
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                  <button class="btn btn-darkgold logbtn">تسجيل الخروج</button>
                 </form>
              </div> --}}
            @endauth
            @guest
                <div class="d-flex align-items-center">
                    {{-- <p><span>10</span>استشارة متبقية</p> --}}
                    <a class="btn btn-darkgold logbtn" href="{{ route('login.view')}}">تسجيل الدخول</a>
                    {{-- <a class="btn btn-darkgold logbtn" href="">تسجيل خروج</a> --}}
                </div>
            @endguest
           

          </div>


          
        </div>
      </nav>
    {{-- end navbar --}}
    
    {{-- start content --}}
    @yield('content')
    {{-- end content --}}
    @if($basic->whatsapp)
        {{-- start footer --}}
        <a class="whatsapp-btn" href="https://wa.me/{{$basic->whatsapp}}" target="_blank"><i class="fa fab fa-whatsapp"></i></a>
    @endif

            <div class="spinnerloader">
            <div class="lds-facebook"><div></div><div></div><div></div></div>
            </div>
    
    <footer class="pt-5 pb-3">
        <div class="container position-relative z-2">
            <div class="row text-center justify-content-around">
                <div class="col-md-3 col-12">
                    <div class="row d-flex align-items-start">
                        <div class="col-4">
                            <img src="{{asset(env('APP_ASSETS').'/'.'assets/images/new.png')}}" class="img-fluid me-2" alt=""/>
                        </div>
                        <div class="col-8">
                            <h6>{{$basic->name}}</h6>
                            <p class="logoslo">{{$basic->description}}</p>
                        </div>
                    </div>
                    <h6 style="font-size: 1.1rem">السياسات والخصوصية</h6>
                    <ul class="fast-link">
                        <li><a href="{{ route('privacy-and-policy') }}">سياسة الخصوصية</a></li>
                        <li><a href="{{ route('terms-and-conditions') }}">الشروط والاحكام</a></li>
                        <li><a href="{{ route('return-policy') }}">سياسة الاسترجاع</a></li>
                    </ul>
                    {{-- <p class="my-3">شركة متخصصة فى مجالات الاستشارات الاستراتيجية والحوكمة ووضع القواعد للشركات ومساعدة الشركات.</p> --}}
                </div>
                <div class="col-md-3 col-6">
                    <h6>روابط سريعة</h6>
                    <ul class="fast-link">
                        <li><a href="{{ route('index') }}">الرئيسية</a></li>
                        <li><a href="{{ route('about') }}">من نحن</a></li>
                        <li><a href="{{ route('services') }}">الخدمات</a></li>
                        <li><a href="{{ route('articals') }}">المقالات</a></li>
                        <li><a href="{{ route('contact.view') }}">تواصل معنا</a></li>
                        
                    </ul>
                </div>
                <div class="col-md-3 col-6 mb-2">
                    <h6>التواصل</h6>
                    <table class="w-100">
                        <tr>
                            <td> <div class="icon"><i class="fa-solid fa-location-dot"></i></div></td>
                            <td>{{$basic->address}}</td>
                        </tr>
                        <tr>
                            <td><div class="icon"><i class="fa-solid fa-phone-volume"></i></div></td>
                            <td>{{$basic->phone}}</td>
                        </tr>
                        <tr>
                            <td><div class="icon"><i class="fa fa-solid fa-paper-plane"></i></div></td>
                            <td>{{$basic->email}}</td>
                        </tr>
                        @if($basic->whatsapp)
                        <tr>
                            <td><div class="icon"><i class="fa fab fa-whatsapp"></i></div></td>
                            <td>{{$basic->whatsapp}}</td>
                        </tr>
                        @endif
                    </table>
                </div>
                <div class="col-md-3 col-12">
                    <h6>التواصل الإجتماعى</h6>
                    <div class="social d-flex justify-content-around">
                        @if($basic->facebook)
                        <a class="icon" href="{{$basic->facebook}}" target="_blank">
                            <i class="fa fa-brands fa-facebook-f"></i>
                        </a>
                        @endif
                        @if($basic->instagram)
                        <a class="icon" href="{{$basic->instagram}}" target="_blank">
                            <i class="fa fa-brands fa-instagram"></i>
                        </a>
                        @endif
                        @if($basic->snapchat)
                        <a class="icon" href="{{$basic->snapchat}}" target="_blank">
                            <i class="fa fa-brands fa-snapchat"></i>
                        </a>
                        @endif
                        @if($basic->linkedin)
                        <a class="icon" href="{{$basic->linkedin}}" target="_blank">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                        @endif
                        @if($basic->twitter)
                        <a class="icon" href="{{$basic->twitter}}" target="_blank">
                            <i class="fa fa-brands fa-twitter"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="line mt-3"></div>
            <p class="bottomfooter mt-3 text-center">جميع الحقوق محفوظة &copy; لشركة <span>{{$basic->name}}  - {{$basic->description}}</span></p>
            <p class="bottomfooter mt-3 text-center"><a href="https://www.vision-things.com" target="_blank" rel="noopener">&#9415;رؤية الأشياء لتقنية المعلومات</a></p>
        </div>
    </footer>
    {{-- end footer --}}

    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/jquery.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/fontawesome/js/all.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/main.js')}}"></script>
</body>
</html>