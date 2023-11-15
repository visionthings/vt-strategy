<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/fontawesome/css/all.min.css')}}" />
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/bootstrap.rtl.css')}}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"/>
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/mainstyle.css')}}" />
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/dashboard/editcontent/index.css')}}" />
    
    <link rel="icon" href="{{asset(env('APP_ASSETS').'/'.'assets/images/new.png')}}" type="image/png">
    <title>تغيير وتعديل المحتوي</title>
</head>
<body>
    <nav class="navbar navbar-expand-md">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"><img src="{{$basicData->getFirstMediaUrl('logo')}}" alt="رؤية الاشياء للاستشارات الاستراتيجية" width="135px"/>
          </a>
          <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarBasic" aria-controls="navbarBasic" aria-expanded="false" aria-label="Toggle navigation">
            {{-- <span class="navbar-toggler-icon"></span> --}}
            <i class="fa fa-solid fa-bars"></i>
          </button>
          <div class="navbar-collapse collapse" id="navbarBasic" style="">
            <ul class="navbar-nav ms-auto mb-2 mb-xl-0">
              <li class="nav-item active">
                <a class="nav-link " aria-current="page" href="{{route('basic.data.view')}}">البيانات الاساسية</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('home.data.view')}}">الصفحة الرئيسية</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('about.data.view')}}">من نحن</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('privacy.data.view')}}">السياسة والخصوصية</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('terms.data.view')}}">الشروط والاحكام</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('return.data.view')}}">سياسة الاسترجاع</a>
              </li>
              <li class="nav-item">
                <a class="btn btn-lightgold" href="{{route('admin.index')}}"><i class="fa-solid fa-gauge"></i>لوحة التحكم</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
    
    <h3 class="mt-3 text-center">تعديل المحتوي العام</h3>
    
    @if(Session::get('success'))
    <div class="successalert">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{Session::get('success')}}
    </div>
    @endif
    <div class="main p-4">
        <form action="{{route('basic.data.update')}}" class="w-75 m-auto" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <h5>الشاشة الرئيسية</h5>
                <div class="col-md-6 mb-2">
                  <label for="compName">اسم الشركة</label>
                  <input type="text" id="compName" name="name" class="form-control" placeholder="اسم الشركة" value="{{old('name',$basicData->name)}}">
                </div>
                <div class="col-md-6 mb-2">
                  <label for="mainSlo">جملة الوصف الرئيسية</label>
                  <input type="text" id="mainSlo" name="description" class="form-control" placeholder="الوصف الرئيسي" value="{{old('description',$basicData->description)}}">
                </div>
                <h5>الشعار</h5>
                <div class="logo-preview-container">
                  <img src="{{$basicData->getFirstMediaUrl('logo')}}">
                </div>
                <hr>
                <h5>الايقون</h5>
                <div class="logo-preview-container">
                  <img  src="{{$basicData->getFirstMediaUrl('icon')}}">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="image">الشعار الرئيسي بالكلمة Png</label>
                    <input type="file" accept="image/png" id="image" name="logo" class="form-control">
                </div>
                
                <div class="col-md-12 mb-3">
                    <label for="icon">الايكون Png</label>
                    <input type="file" accept="image/png" id="icon" name="icon" class="form-control">
                </div>
                <hr>
             
                <h5>بيانات التواصل</h5>
                <div class="col-md-6 mb-3">
                  @error('phone')
                  <p class="alert alert-danger">{{$message}}</p>
                  @enderror
                    <label for="phone">رقم الهاتف</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="رقم الهاتف" value="{{old('phone',$basicData->phone)}}">
                </div>
           
                <div class="col-md-6 mb-3">
                  @error('whatsapp')
                  <p class="alert alert-danger">{{$message}}</p>
                  @enderror
                    <label for="whatsapp">رقم الواتساب</label>
                    <input type="text" name="whatsapp" id="whatsapp" class="form-control" placeholder="رقم الواتساب" value="{{old('whatsapp',$basicData->whatsapp)}}">
                </div>
         
                <div class="col-md-12 mb-3">
                  @error('email')
                  <p class="alert alert-danger">{{$message}}</p>
                  @enderror
                    <label for="email">البريد الالكتروني</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="البريد الالكتروني" value="{{old('email',$basicData->email)}}"> 
                </div>
              
                <div class="col-md-12 mb-3">
                  @error('address')
                  <p class="alert alert-danger">{{$message}}</p>
                  @enderror
                    <label for="address">العنوان</label>
                    <input type="text" id="address" name="address" class="form-control" placeholder="العنوان" value="{{old('address',$basicData->address)}}">
                </div>
                <hr>
                <h5>التواصل الاجتماعي</h5>
                <div class="col-md-12 mb-3">
                  <label for="face">الفيسبوك</label>
                  <input type="text" id="face" name="facebook" class="form-control" placeholder="ادخل لينك الصفحة" value="{{old('facebook',$basicData->facebook)}}">
                </div>
                <div class="col-md-12 mb-3">
                  <label for="insta">الانستجرام</label>
                  <input type="text" id="insta" name="instagram" class="form-control" placeholder="ادخل لينك الصفحة" value="{{old('instagram',$basicData->instagram)}}">
                </div>
                <div class="col-md-12 mb-3">
                  <label for="snap">سناب شات</label>
                  <input type="text" id="snap" name="snapchat" class="form-control" placeholder="ادخل لينك الصفحة" value="{{old('snapchat',$basicData->snapchat)}}">
                </div>
                <div class="col-md-12 mb-3">
                  <label for="linked">لينكد ان</label>
                  <input type="text" id="linked" name="linkedin" class="form-control" placeholder="ادخل لينك الصفحة" value="{{old('linkedin',$basicData->linkedin)}}"> 
                </div>
                <div class="col-md-12 mb-3">
                  <label for="twitter">تويتر</label>
                  <input type="text" id="twitter" name="twitter" class="form-control" placeholder="ادخل لينك الصفحة" value="{{old('twitter',$basicData->twitter)}}">
                </div>


                <div class="col-md-12">
                    <button class="btn btn-darkgold"><i class="fa-solid fa-floppy-disk me-2"></i>حفظ التعديلات</button>
                </div>
            </div>
        </form>
    </div>
      
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/jquery.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/fontawesome/js/all.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/bootstrap.bundle.min.js')}}"></script>
  
</body>
</html>


