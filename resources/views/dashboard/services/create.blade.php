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
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/dashboard/services/create.css')}}" />
    <title>اضافة خدمة جديدة</title>
</head>
<body>
    <div class="add-consultation-container">
        
        <div class="add-consultation-routes"> 
            <a href="{{route('services.index')}}">
                <button class="btn btn-darkgold">
                    <i class="fa-brands fa-servicestack"></i> جميع الخدمات 
                </button>
            </a>
            <a href="{{route('admin.index')}}">
                <button class="btn btn-lightgold">
                    <i class="fa-solid fa-gauge"></i>  لوحة التحكم 
                </button>
            </a>    
        </div>

        <div class="add-consultation-content">

            <div class="add-consultation p-2">
                <form action="{{route('services.store')}}" method="POST" enctype="multipart/form-data">
                    
                    <img src="{{asset(env('APP_ASSETS').'/'.'assets/images/New.png')}}" class="w-25" alt="">
                    @csrf
                    <div>
                        <label for="name d-block">أسم الخدمة</label>
                        @error('name')
                          <p class="error-alert-danger">{{$message}}</p>  
                        @enderror
                        <input type="text" name="name" class="form-control mb-3" id="name" placeholder="أسم الخدمة">
                    </div>
                    <div>
                        <label for="description">  وصف الخدمة </label>
                        @error('description')
                        <p class="error-alert-danger">{{$message}}</p>  
                        @enderror
                        <textarea class="form-control mb-3" name="description"></textarea>
                    </div>
                    <div>
                        <label for="status">حالة الخدمة</label>
                        @error('status')
                        <p class="error-alert-danger">{{$message}}</p>  
                        @enderror
                        <select name="status" class="form-control mb-3">
                            <option value="active">نشطة</option>
                            <option value="archived">مؤرشفة</option>
                        </select>
                    </div>
                    <div>
                        <label for="important"> مهمة </label>
                        @error('important')
                        <p class="error-alert-danger">{{$message}}</p>  
                        @enderror
                        {{-- <input type="checkbox" id="important" name="important" value="1"> --}}
                        <div class="form-check form-switch d-flex align-items-center">
                            <input class="form-check-input me-3" type="checkbox" value="1" name="important" id="important">
                            {{-- <label class="form-check-label" for="tax">إضافة ضريبة</label> --}}
                        </div>
                    </div>
                    <div>
                        <label for="image"> صورة غلاف للخدمة </label>
                        @error('image')
                        <p class="error-alert-danger">{{$message}}</p>  
                        @enderror
                        <input type="file" id="image" name="image" class="form-control">
                    </div>
                    <br>
                    <div>
                        <button class="btn btn-darkgold">إضافه</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/jquery.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/fontawesome/js/all.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
