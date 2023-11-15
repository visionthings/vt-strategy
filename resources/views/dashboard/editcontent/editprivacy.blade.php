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
    <script src="https://cdn.tiny.cloud/1/heqtf3zbvoypeuwn1nedoqyo5u7hi9vxs8243gvlt96yd2ev/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/dashboard/editcontent/index.css')}}" />
    <link rel="icon" href="{{asset(env('APP_ASSETS').'/'.'assets/images/new.png')}}" type="image/png">
    <title>تعديل السياسة والخصوصية</title>
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
              <li class="nav-item">
                <a class="nav-link" href="{{route('about.data.view')}}">من نحن</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" aria-current="page" href="{{route('privacy.data.view')}}">السياسة والخصوصية</a>
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
    
    <h3 class="mt-3 text-center">تعديل السياسة والخصوصية</h3>
    @if(Session::get('success'))
    <div class="successalert">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{Session::get('success')}}
    </div>
    @endif
    
    <div class="main p-4">
        <form action="{{route('privacy.data.update',$privacy->id)}}" class="100 m-auto" method="POST">
          @csrf
          @method('PUT')
            <div class="row">
                <h5>السياسة والخصوصية</h5>
                <label for="privacyData">بيانات صفحة السياسة والخصوصية</label>
                <textarea id="privacyData" name="content">{{old('content',$privacy->content)}}</textarea>
                <button class="btn btn-darkgold btnwidth"><i class="fa-solid fa-floppy-disk me-2"></i>حفظ التعديلات</button>
            </div>
        </form>
    </div>
      
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/jquery.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/fontawesome/js/all.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/bootstrap.bundle.min.js')}}"></script>
    <script>
      tinymce.init({
        selector: 'textarea',
        directionality : "rtl",
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
      });
    </script>
</body>
</html>


