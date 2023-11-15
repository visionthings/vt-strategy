<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/bootstrap.rtl.css')}}">
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/mainstyle.css')}}">
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/auth/login.css')}}">
    
    <link rel="icon" href="{{asset(env('APP_ASSETS').'/'.'assets/images/new.png')}}" type="image/png">
    <title>تسجيل الدخول</title>
</head>
<body>
            
  @if(Session::has('faild'))
    <div class="erroralert ">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{$message = Session::get('faild')}}
    </div>
  @endif
 
  @if(Session::has('registerActive'))
    <div class="successalert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{$message = Session::get('registerActive')}}
    </div>
  @endif 

  @if(Session::has('failedCode'))
    <div class="erroralert ">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{$message = Session::get('failedCode')}}
    </div>
   @endif
    <div class="wrapper fadeInDown">
        <div id="formContent">
          <div class="login">
            <!-- Tabs Titles -->
            <h2 class="active">  تفعيل الحساب </h2>
        
            <!-- Icon -->
            <a class="fadeIn first d-block" href="/">
                <img src="{{asset(env('APP_ASSETS').'/'.'assets/images/new.png')}}" id="icon" class="" alt="رؤية الاشاء للإستشارات" />
            </a>
            <!-- Login Form -->
            <form id="loginForm" action="{{route('register.active')}}" method="POST" novalidate>
                @csrf
                @error('active')
                  <p class="alert alert-danger">{{$message}}</p>
                @enderror

                <input type="text" id="code" class="fadeIn second" name="code" placeholder="كود التفعيل" required>
                
                <input type="submit" class="fadeIn fourth" value="تفعيل الحساب">
            </form>
        
            <!-- Remind Passowrd -->
            <div class="formFooter" id="loginfooter">
                <a class="underlineHover" href="{{route('register.view')}}">مستخدم جديد</a>
                <a class="underlineHover" href="#">نسيت كلمة السر؟</a>
            </div>
          </div>
        </div>
      </div>

    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/jquery.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/fontawesome/js/all.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/dashboard/login.js')}}"></script>
</body>
</html>