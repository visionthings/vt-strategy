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
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/dashboard/consultations/create.css')}}" />
    
    <link rel="icon" href="{{asset(env('APP_ASSETS').'/'.'assets/images/new.png')}}" type="image/png">
    <title>تعديل بيانات متحكم</title>
</head>
<body>
    <div class="add-consultation-container">
        
        <div class="add-consultation-routes"> 
            <a href="{{route('admins.view')}}">
                <button class="btn btn-darkgold">
                    <i class="fa-solid fa-handshake"></i> جميع المتحكمين 
                </button>
            </a>
            <a href="{{route('admin.index')}}">
                <button class="btn btn-lightgold">
                    <i class="fa-solid fa-gauge"></i> لوحة التحكم 
                </button>
            </a>
        </div>

        <h3 style="color: var(--lightgold);" class="text-center">تعديل بيانات المتحكمين</h3>
    
        <div class="add-consultation-content">
            <div class="add-consultation">
                <form action="{{route('admin.update',$admin->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    @error('first_name')
                        <p class="alert alert-danger">{{$message}}</p>
                    @enderror
                   <label for="name">الاسم الاول</label>
                   <input class="form-control mb-3" id="first_name" name="first_name" type="text" value="{{old('first_name',$admin->first_name)}}" placeholder="الاسم الاول">
                   @error('last_name')
                   <p class="alert alert-danger">{{$message}}</p>
                    @enderror
                   <label for="name">الاسم الاول</label>
                   <input class="form-control mb-3" id="last_name" name="last_name" type="text" value="{{old('last_name',$admin->first_name)}}" placeholder="الاسم الاخير">
                   @error('email')
                   <p class="alert alert-danger">{{$message}}</p>
                   @enderror
                   <label for="email">البريد الالكتروني</label>
                   <input class="form-control mb-3" id="email" type="email" name="email" value="{{old('email',$admin->email)}}" placeholder="البريد الالكتروني">
                   @error('password')
                   <p class="alert alert-danger">{{$message}}</p>
                   @enderror
                   <label for="password">كلمة السر (يمكنه تغييرها من داخل حسابه)</label>
                   <input class="form-control mb-3" id="password" type="password" name="password" placeholder="كلمة السر">
                 
                   @error('phone')
                   <p class="alert alert-danger">{{$message}}</p>
                   @enderror
                   <label for="phone">رقم الهاتف</label>
                   <input class="form-control mb-3" id="phone" type="text" name="phone" value="{{old('phone',$admin->phone)}}" placeholder="رقم الهاتف">
                   @error('status')
                   <p class="alert alert-danger">{{$message}}</p>
                   @enderror
                   <select name="status" class="form-control mb-3">
                    <option value="admin" @if($admin->status =='admin') selected @endif>مسؤل</option>
                    <option value="super_admin" @if($admin->status =='super_admin') selected @endif>ادارة عليا</option>
                   </select>
                   
                   <button class="btn btn-darkgold"><i class="fa-solid fa-plus me-1"></i>اضافة متحكم جديد</button>
                </form>
            </div>
        </div>
    </div>


    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/jquery.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/fontawesome/js/all.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/bootstrap.bundle.min.js')}}"></script>

</body>
</html>