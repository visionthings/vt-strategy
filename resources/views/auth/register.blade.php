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
    <title>مستخدم جديد</title>
</head>
<body>
  
    <div class="wrapper fadeInDown">
        <div id="formContent">
          <div class="register">
            <h2 class="active">تسجيل مستخدم جديد</h2>
        
            <!-- Icon -->
            <a class="fadeIn first d-block" href="/">
                <img src="{{asset(env('APP_ASSETS').'/'.'assets/images/new.png')}}" id="icon" class="" alt="رؤية الاشياء للاستشارات" />
            </a>
            <form id="registerForm" action="{{route('register')}}" method="post" novalidate>
                @csrf
                @error('name')
                  <div class="erroralert">
                      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                      {{$message}}
                  </div>
                @enderror
                <input type="text" id="name" class="fadeIn first" name="name" placeholder="الاسم بالكامل" required>
                @error('email')
                  <div class="erroralert">
                      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                      {{$message}}
                  </div>
                @enderror
                <input type="email" id="email" class="fadeIn second" name="email" placeholder="البريد الإلكتروني" required>
                @error('password')
                  <div class="erroralert">
                      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                      {{$message}}
                  </div>
                @enderror
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="كلمة السر" required>
                @error('password_confirmation')
                <div class="erroralert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    {{$message}}
                </div>
                @enderror
                <input type="password" id="confirmPassword" class="fadeIn fourth" name="password_confirmation" placeholder="اعد كلمة السر" required>
                @error('phone')
                <div class="erroralert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    {{$message}}
                </div>
                @enderror
                <input type="text" id="phone" class="fadeIn fourth" name="phone" placeholder="رقم الهاتف" required>

                <input type="submit" class="fadeIn fourth btn btn-primary" value="التسجيل">
            </form>
            
            <div class="formFooter" id="loginfooter">
                <a class="underlineHover" href="/login">لديك حساب بالفعل</a>
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