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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"/>
    <script src="https://cdn.tiny.cloud/1/heqtf3zbvoypeuwn1nedoqyo5u7hi9vxs8243gvlt96yd2ev/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/dashboard/editcontent/index.css')}}" />
    
    <link rel="icon" href="{{asset(env('APP_ASSETS').'/'.'assets/images/new.png')}}" type="image/png">
    <title>تعديل من نحن</title>
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
              <li class="nav-item">
                <a class="nav-link" href="{{route('basic.data.view')}}">البيانات الاساسية</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('home.data.view')}}">الصفحة الرئيسية</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" aria-current="page" href="{{route('about.data.view')}}">من نحن</a>
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
    
    <h3 class="mt-3 text-center">تعديل من نحن</h3>
    @if(Session::get('success'))
    <div class="successalert">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{Session::get('success')}}
    </div>
    @endif
    <div class="main p-4">
        <form action="{{route('about.data.update',$about->id)}}" class="w-75 m-auto" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                {{-- <h5>الواجهة</h5>
                <div class="col-md-6 mb-2">
                  <label for="aboutheader">العنوان</label>
                  <input type="text" id="aboutheader" class="form-control" placeholder="العنوان">
                </div>
                <div class="col-md-6 mb-2">
                  <label for="aboutslo">جملة الوصف</label>
                  <input type="text" id="aboutslo" class="form-control" placeholder="الجملة التوضيحية">
                </div>
               <hr> --}}
                
               <h5>من نحن</h5>
               @error('image')
                <p class="alert alert-danger">{{$message}}</p>
               @enderror
                <div class="about-image-preview-container">
                  <img src="{{$about->getFirstMediaUrl('about')}}">
                </div>
              
               <div class="col-md-6 mb-2">
                <label for="pic">الصورة</label>
                <input type="file" accept="image/png, image/jpeg" id="pic" name="image" class="form-control">
               </div>
               <div class="col-md-6 mb-2">
                <label for="slo">الجملة التوضيحية</label>
                <input type="text" id="short_text" name="short_text"  class="form-control" placeholder="التوضيح" value="{{old('short_text',$about->short_text)}}">
               </div>
               @error('content')
                <p class="alert alert-danger">{{$message}}</p>
               @enderror
               <div class="col-md-12 mb-2">
                <label for="content">المحتوي</label>
                <textarea name="content" id="content" class="form-control" placeholder="المقال">{{old('content',$about->content)}}</textarea>
               </div>
               <div class="col-md-12 mb-2">
                <button class="btn btn-darkgold"><i class="fa-solid fa-floppy-disk me-2"></i>حفظ التعديلات</button>
               </div>
            </div>
        </form>
    </div>
      
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/jquery.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/fontawesome/js/all.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/bootstrap.bundle.min.js')}}"></script>
    <script>
           tinymce.init({
              selector: 'textarea',
              plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
              toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            });
    </script>
</body>
</html>


