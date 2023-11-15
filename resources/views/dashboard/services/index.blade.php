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
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/dashboard/services/index.css')}}" />
    <title>جميع الخدمات</title>
</head>
<body>
        
        @if(Session::get('success'))
        <div class="successalert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            {{$message = Session::get('success')}}
        </div>
        @endif
        @if(Session::get('delete'))
        <div class="erroralert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            {{$message = Session::get('delete')}}
        </div>
        @endif
    
        <div class="main">
          <div class="container">
            <div class="main-sub row align-items-center pt-5">
              </div>
              <div class="table-container mt-2">
    
                <div class="mb-2 d-flex justify-content-between align-items-center routes">
                        
                        <div class="d-flex">
                            <a href="{{route('services.create')}}">
                                <div class="text-secondary m-2">
                                    <button class="btn btn-darkgold">
                                      <i class="fa-solid fa-plus"></i> إضافة  
                                    </button>
                                </div>
                              </a>
                             <h2 class="m-2">إضافة خدمة جديدة</h2>
            
                        </div>
    
                        <div>
                            <a href="{{route('admin.index')}}">
                                <button class="btn btn-lightgold">
                                <i class="fa-solid fa-gauge"></i>  لوحة التحكم 
                                </button>
                            </a>
                        </div>
                        
                </div>
             
                <table id="mytable" class="table  align-middle mb-0 bg-white mt-4">
                  <thead>
                    <tr class="header-row">
                        <th>أسم الخدمة</th>
                        <th>بواسطة</th>
                        <th> حالة الخدمة </th>
    
                        <th>تاريخ انشاء الخدمة</th>
                        <th>عدد المنشورات</th>
                        <th>عرض التفاصيل</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($services as $service)
                    <tr>
                        <td>{{$service->name}}</td>
                        <td>{{$service->admin->fullname}}</td>
                        <td>
                            @if($service->status =="active")
                            <span class="active_status">
                                <i class="fa-solid fa-chart-line"></i> نشطة
                            </span>
                            @else
                            <span class="arcived_status">
                                <i class="fa-solid fa-folder"></i> مؤرشفة 
                            </span>
                            @endif
                        </td>
    
                        <td>{{date('Y/m/d ( H:m A )', strtotime($service->admin->created_at));}}</td>
                        <td>{{$service->contents->count()}}</td>
                        <td>
                            <a href="{{route('services.show',$service->id)}}">
                                <button type="submit" class="btn btn-info">
                                    <i class="fa-regular fa-eye"></i> عرض التفاصيل 
                                </button>
                            </a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning edit-service" data-id="{{$service->id}}">
                                <i class="fa-regular fa-pen-to-square"></i> تعديل الخدمة
                            </button>
                            <div class="edit-service-conteiner" data-id="{{$service->id}}">
                                <div class="close-btn" data-id="{{$service->id}}">
                                    <span>
                                        <i class="fa-solid fa-xmark"></i>
                                    </span>
                                </div>
                                <div class="edit-service-content">
                                    <div class="edit-service">
                                        <form action="{{route('services.update',$service->id)}}" class="edit-form-box" method="POST" enctype="multipart/form-data">
                                            <img style="width: 100px; object-fit:cover;" src="{{$service->getFirstMediaUrl('service')}}">
                                            @csrf
                                            @method('PUT')
                                            <div>
                                                <label for="name">أسم الخدمة</label>
                                                <input type="text" name="name" id="name" class="form-control mb-3" value="{{$service->name}}">
                                            </div>

                                            <div>
                                                <label for="description">  وصف الخدمة </label>
                                                @error('description')
                                                <p class="error-alert-danger">{{$message}}</p>  
                                                @enderror
                                                <textarea class="form-control mb-3" name="description">{{$service->description}}</textarea>
                                            </div>
                                               
                                            <div>
                                                <label for="status">حالة الخدمة</label>
                                                <select name="status" id="status" class="form-control mb-3">
                                                    <option value="active" @if($service->status =='active') selected   @endif>
                                                        نشط
                                                    </option>
                                                    <option value="archived" @if($service->status =='archived') selected   @endif>
                                                        مؤرشف
                                                    </option>
                                                </select>
                                           </div>
                                           <div>
                                                <label for="image"> صورة غلاف للخدمة </label>
                                                @error('image')
                                                <p class="error-alert-danger">{{$message}}</p>  
                                                @enderror
                                                <input type="file" id="image" name="image" class="form-control mb-3">
                                            </div>
                                            <div>
                                                <label for="important{{$service->id}}"> مهمة </label>
                                                @error('important')
                                                <p class="error-alert-danger">{{$message}}</p>  
                                                @enderror
                                                <input type="checkbox" id="important{{$service->id}}" name="important" @if ($service->important == 1) checked @endif value="1">
                                            </div>

                                      
                                            <div>
                                                <button type="submit" class="btn btn-darkgold">حفظ</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <form action="{{route('services.destroy',$service->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div>
                                    <button type="submit" class="btn btn-danger"> 
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </form> 
                        </td>
    
                     
                    </tr>
                    @empty
                    <h3 class="empty-consultation">
                        لا يوجد خدمات حتي الآن
                    </h3>
                    @endforelse
                  </tbody>
                </table>
    
            </div>
            </div>
          </div>
        </div>
    
      
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/jquery.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/fontawesome/js/all.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/bootstrap.bundle.min.js')}}"></script>
    <script>
        $(".edit-service").on("click", function() {
          let id = $(this).data('id');
          $('.edit-service-conteiner[data-id='+id+']').toggle();
        });
        $(".close-btn").on("click", function() {
          let id = $(this).data('id');
          $('.edit-service-conteiner[data-id='+id+']').toggle();
        });
    
      </script>
</body>
</html>


