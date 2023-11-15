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
  <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/dashboard/consultations/index.css')}}" />
  
  <link rel="icon" href="{{asset(env('APP_ASSETS').'/'.'assets/images/new.png')}}" type="image/png">
  <title>ادارة المتحكمين</title>
</head>
<body>
  @if(Session::get('success'))
    <div class="successalert ">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{$message = Session::get('success')}}
    </div>
  @endif
  @if(Session::get('failed'))
  <div class="alert alert-danger">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
      {{$message = Session::get('failed')}}
    </div>
  @endif
  
  <div class="main">
    <div class="container">
      <div class="main-sub row align-items-center pt-4">
        </div>
        <div class="table-container mt-5">

          <div class="mb-2 d-flex justify-content-between align-items-center routes">

            <div class="d-flex">

                <a href="{{route('add.admin.view')}}">
                  <div class="text-secondary m-2">
                      <button class="btn btn-darkgold">
                        <i class="fa-solid fa-plus"></i> إضافة متحكم جديد  
                      </button>
                  </div>
                </a>
               <h2 class="m-2">إضافة مسؤل جديد</h2>

            </div>

            <div>
              <a href="{{route('admin.index')}}">
                  <button class="btn btn-lightgold">
                    <i class="fa-solid fa-gauge"></i>  لوحة التحكم 
                  </button>
              </a>
            </div>


          </div>

          <table id="mytable" class="table align-middle mb-0 bg-white mt-4">
            <thead class="bg-light">
              <tr class="header-row">
                  <th>أسم المتحكم</th>
                  <th>البريد الإلكتروني</th>
                  <th>رقم الهاتف</th>
                  <th> الرتبه</th>
                  <th>تعديل البيانات</th>
                  <th>مسح المتحكم</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($admins as $admin)
                <tr>
                    <td>{{$admin->first_name}} {{$admin->last_name}}</td>
                    <td>{{$admin->email}}</td>
                    <td>{{$admin->phone}}</td>
                    <td>
                      @if ($admin->status == 'super_admin')
                        ادارة عليا
                        @else
                        مسؤل
                      @endif
                    </td>
        

                    <td class="d-flex flex-shrink-0 align-items-center justify-content-center">
                      @if (auth('admin')->user()->status =='super_admin')
                        <a href="{{route('admin.update.view',$admin->id)}}" class="btn btn-warning d-flex align-items-center justify-content-center"><i class="fa-solid fa-circle-info me-1"></i>تعديل البيانات</a>
                      @else
                      غير مصرح لك
                      @endif
                      </td>

                    @if (auth('admin')->user()->status =='super_admin')
                      
                    <td class="flex-shrink-0 align-items-center justify-content-center">
                      
                        <form action="{{route('admin.delete',$admin->id)}}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-trash me-1"></i>
                             
                          </button>
                        </form>
                    </td>
                    @else
                    <td class="flex-shrink-0 align-items-center justify-content-center">
                      غير مصرح لك
                    </td>
                    @endif
                </tr>
                @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>




    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/jquery.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/fontawesome/js/all.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/bootstrap.bundle.min.js')}}"></script>

    

</body>
</html>
  
