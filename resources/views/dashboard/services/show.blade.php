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
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/dashboard/services/show.css')}}" />
    <title>عرض تفاصيل الخدمة</title>
</head>
<body>
    <div class="main">
        <div class="container">
          <div class="main-sub row align-items-center pt-5">
            </div>
            <div class="table-container mt-4">
  
              <div class="mb-2 d-flex justify-content-between  align-items-center routes">
                      
                      <div class="d-flex">
                          <a href="{{route('services.index')}}">
                              <div class="text-secondary m-2">
                                  <button class="btn btn-darkgold">
                                      <i class="fa-brands fa-servicestack"></i> جميع الخدمات   
                                  </button>
                              </div>
                            </a>
                      </div>
  
                      <div>
                          <a href="{{route('admin.index')}}">
                              <button class="btn btn-lightgold">
                                  <i class="fa-solid fa-gauge"></i>  لوحة التحكم 
                              </button>
                          </a>
                      </div>
                      
              </div>
           
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
              @error('title')
              <div class="erroralert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                  {{$message}}
              </div>
              @enderror
              @error('yt_video')
              <div class="erroralert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                  {{$message}}
              </div>
              @enderror
              @error('content')
              <div class="erroralert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                  {{$message}}
              </div>
              @enderror
              @error('status')
              <div class="erroralert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                  {{$message}}
              </div>
              @enderror
              @error('service_id')
              <div class="erroralert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                  {{$message}}
              </div>
              @enderror
           
              <table id="mytable" class="table align-middle mb-0 bg-white mt-4">
                <thead class="bg-light">
                  <tr class="header-row">
                      <th>عنوان المنشور</th>
                      <th>محتوي المنشور</th>
                      <th>فيديو اليوتيوب</th>
                      <th>حالة المنشور</th>
                      <th>تاريخ إنشاء المنشور</th>
                      <th>تعديل</th>
                      <th>عرض المنشور في الخارج</th>
                      <th>حذف المنشور</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($contents as $content)
                  <tr>
                      <td>{{$content->title}}</td>
                      <td>
                          <button type="button" class="btn btn-info show-content-btn" data-id="{{$content->id}}">
                              عرض المنشور
                          </button>
                          <div class="pop-content-container" data-id="{{$content->id}}">
                              <div class="close-btn" data-id="{{$content->id}}">
                                  <span>
                                      <i class="fa-solid fa-xmark"></i>
                                  </span>
                              </div>
                              <div class="pop-content-content">
                                  <div class="pop-content">
                                      <div class="header">
                                          <h1>{{$content->title}}</h1>
                                          <iframe src="https://www.youtube.com/embed/{{$content->yt_video}}" width="500px" height="300px"></iframe>
                                     </div>
                                     <div class="body">
  
                                          {!! $content->content !!}
                                     </div>
                                  </div>
                              </div>
                          </div>
                      </td>
                      <td>
                          <a href="{{$content->yt_video}}" target="_blank">
                              <i class="fa-brands fa-youtube"></i>
                          </a>
                      </td>
                      <td>
                          @if($content->status =="active")
                          <span class="active_status">نشط</span>
                          @else
                          <span class="arcived_status">مؤرشف</span>
                          @endif
                      </td>
                      <td>{{date('Y/m/d H:m a', strtotime($content->created_at))}}</td>
  
                      <td>
                          <button type="button" class="btn btn-warning edit-content" data-id="{{$content->id}}">
                              <i class="fa-regular fa-pen-to-square"></i> 
                              تعديل المنشور
                          </button>
                          <div class="edit-content-conteiner" data-id="{{$content->id}}">
                              <div class="edit-close-btn" data-id="{{$content->id}}">
                                  <span>
                                      <i class="fa-solid fa-xmark"></i>
                                  </span>
                              </div>
                              <div class="edit-service-content">
                                  <div class="edit-service">
                                      <form action="{{route('contents.update',$content->id)}}" class="edit-form-box" method="POST">
                                          @csrf
                                          @method('PUT')
                                          <div>
                                              <label for="title"> عنوان المنشور</label>
                                              <input type="text" name="title" id="title" value="{{$content->title}}">
                                          </div>
                                           <div>
                                              <label for="content">  محتوي المنشور</label>
                                                  <textarea name="content">
                                                      {!! $content->content !!}
                                                  </textarea>
                                          </div>
                                          @if ($content->yt_video)
                                               <div class="content-yt_video">
                                                  <label for="yt_video"> فيديو المنشور</label>
                                                  <input type="text" name="yt_video" id="yt_video" value="{{$content->yt_video}}">
                                              </div>
                                          @endif
                                         
                                         <div>
                                              <label for="status">حالة المنشور</label>
                                              <select name="status" id="status">
                                                  <option value="active" @if($content->status =='active') selected   @endif>
                                                      نشط
                                                  </option>
                                                  <option value="archived" @if($content->status =='archived') selected   @endif>
                                                      مؤرشف
                                                  </option>
                                              </select>
                                         </div>
                                         <div>
  
                                              <label for="service_id">قسم المنشور</label>
                                              <select name="service_id" id="service_id">
                                                  
                                                  @foreach ($services as $service)
                                                      <option value="{{$service->id}}" @if($content->service_id == $service->id) selected @endif>{{$service->name}}</option>
                                                  @endforeach
                                                
                                              </select>
                                          </div>
                                         
                                          <div>
                                              <button type="submit" class="btn btn-success">حفظ</button>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </td>
  
                      
                      <td>
                        <a href="{{route('articale.show',$content->slug)}}" target="_blank">
                              <button type="submit" class="btn btn-info">
                                  <i class="fa-regular fa-eye"></i> عرض المنشور في الخارج
                              </button>
                          </a>
                      </td>
             
                      <td>
                          <form action="{{route('contents.destroy',$content->id)}}" method="POST">
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
                      لا يوجد منشورات لهذا الخدمة حتي الآن
                  </h3>
                  @endforelse
                </tbody>
              </table>
              {{$contents->links()}}
          </div>
          </div>
        </div>
      </div>
  

    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/jquery.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/fontawesome/js/all.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/bootstrap.bundle.min.js')}}"></script>
    <script>
         $(".edit-content").on("click", function() {
          let id = $(this).data('id');
          $('.edit-content-conteiner[data-id='+id+']').toggle();
        });
        $(".edit-close-btn").on("click", function() {
          let id = $(this).data('id');
          $('.edit-content-conteiner[data-id='+id+']').toggle();
        });
         
        
        $(".show-content-btn").on("click", function() {
          let id = $(this).data('id');
          $('.pop-content-container[data-id='+id+']').toggle();
        });
        $(".close-btn").on("click", function() {
          let id = $(this).data('id');
          $('.pop-content-container[data-id='+id+']').toggle();
        });
      
        tinymce.init({
          selector: 'textarea',
          plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
          toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });

    </script>
</body>
</html>
