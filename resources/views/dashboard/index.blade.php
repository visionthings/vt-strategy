<!DOCTYPE html>
<html dir="rtl">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/fontawesome/css/all.min.css')}}" />
        <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/bootstrap.rtl.css')}}" />
        <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/mainstyle.css')}}" />
        <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/dashboard/index.css')}}" />
        <script src="https://cdn.tiny.cloud/1/heqtf3zbvoypeuwn1nedoqyo5u7hi9vxs8243gvlt96yd2ev/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        <!-- fonts -->
        
        <link rel="icon" href="{{asset(env('APP_ASSETS').'/'.'assets/images/new.png')}}" type="image/png">
        <title>صفحة المسؤول</title>
        {{-- text editor articles --}}

    </head>
    <body>
        
        @if(Session::get('delete'))
        <div class="erroralert ">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            {{$message = Session::get('delete')}}
        </div>
        @endif
        @if(Session::get('success'))
        <div class="successalert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
             {{$message = Session::get('success')}}
        </div>
        @endif
        @if(Session::get('password_error'))
        <div class="erroralert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            {{$message = Session::get('password_error')}}
        </div>
        @endif
        
        @error('password')
        <div class="erroralert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            {{$message}}
        </div>
        @enderror
        @error('date')
            <div class="erroralert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                {{$message}}
            </div>
        @enderror


        @error('title')
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
        @error('service_id')
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
        @error('intro')
            <div class="erroralert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                {{$message}}
            </div>
        @enderror
        @error('image')
            <div class="erroralert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                {{$message}}
            </div>
        @enderror

        
        <div class="sidebar">
            
            <div class="logo p-3">
                <img src="{{asset(env('APP_ASSETS').'/'.'assets/images/Newsloen.png')}}" class="w-100" alt="" />
            </div>
            <ul>
                <h6>الإحصائيات</h6>
                <li data-div-id="statistics" id="statistics-link" class="active"><i class="fa-solid fa-arrow-trend-up"></i><span>الإحصائيات</span></li>
                <a href="{{route('reports')}}">
                    <li>
                        <i class="fa-solid fa-table"></i>
                        <span>التقارير</span>
                    </li>
                </a>
                <h6>المحتوي العام والتحكم</h6>
                <ul>
                    <a href="{{route('basic.data.view')}}">
                        <li>
                            <i class="fa-solid fa-paintbrush"></i>
                            <span>تعديل المحتوي العام</span>
                        </li>
                    </a>
                    <a href="{{route('admins.view')}}">
                        <li>
                            <i class="fa-solid fa-user-plus"></i>
                            <span>المتحكمين</span>
                        </li>
                    </a>
                </ul>
                
                <h6>الخدمات</h6>
                <ul>
                    <a href="{{route('services.index')}}">
                        <li>
                            <i class="fa-solid fa-users-gear"></i>
                            <span>جميع الخدمات</span>
                        </li>
                    </a>
                </ul>

                <h6>المقالات</h6>
                <ul>
                    <li data-div-id="newArticle" id="new-article-link"><i class="fa-solid fa-pen-nib"></i><span>منشور جديد</span></li>
                    <li data-div-id="publishedArticles" id="published-articles-link"><i class="fa-solid fa-newspaper"></i><span> جميع المنشورات </span></li>
                </ul>

                <h6>الإستشارات</h6>
                <ul>
                    <a href="{{route('consultations.index')}}">
                        <li>
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>جميع الاستشارات</span>
                        </li>
                    </a>

                    <li data-div-id="bookedConsultations" id="bookedConsultations-link">
                        <i class="fa-solid fa-calendar-check"></i>
                        <span>الإستشارات المحجوزة</span>
                    </li>
                </ul>
                <h6>الرسائل</h6>
                <li data-div-id="messages" id="messages-link"><i class="fa-solid fa-message"></i><span>الرسائل</span></li>
                <h6>إعدادات الحساب</h6>
                <li data-div-id="changePass" id="changePass-link"><i class="fa-solid fa-unlock"></i><span>تغيير كلمة السر</span></li>
            </ul>
        </div>
       
        <div class="nav d-flex justify-content-between">
            <i id="sidetoggler" onclick="toggleSidebar()" class="fa-solid fa-bars"></i>
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    {{Auth::guard('admin')->user()->first_name.' '.Auth::guard('admin')->user()->last_name}}
                    {{-- م.هتان --}}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li>
                        <form action="{{route('admin.logout')}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger dropdown-item"> 
                                تسجيل الخروج
                            </button>
                        </form>
                       
                    </li>
                </ul>
            </div>
        </div>


        <div class="content">
            <div id="statistics" class="p-3">
                <div class="row">
                    <div class="col-md-3 col-6 p-1">
                        <div class="rounded-3 bg-black p-3 h-100">
                            <div class="row align-items-center small-box">
                                <div class="col-5"><img src="{{asset(env('APP_ASSETS').'/'.'assets/images/team.png')}}" class="w-100" alt="عدد الزائرين"></div>
                                <div class="col-7">
                                    <h6 class="red">الزائرين اليوم</h6>
                                    <span>{{$getViewCount}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 p-1">
                        <div class="rounded-3 bg-black p-3 h-100">
                            <div class="row align-items-center small-box">
                                <div class="col-5"><img src="{{asset(env('APP_ASSETS').'/'.'assets/images/conversation.png')}}" class="w-100" alt="عدد الزائرين"></div>
                                <div class="col-7">
                                    <h6 class="blue">استشارات ناجحة</h6>
                                    <span>{{$consultationsSuccess}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 p-1">
                        <div class="rounded-3 bg-black p-3 h-100">
                            <div class="row align-items-center small-box">
                                <div class="col-5"><img src="{{asset(env('APP_ASSETS').'/'.'assets/images/time-management.png')}}" class="w-100" alt="عدد الزائرين"></div>
                                <div class="col-7">
                                    <h6 class="green">استشارات جديدة</h6>
                                    <span>{{$consultationsPending}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 p-1">
                        <div class="rounded-3 bg-black p-3 h-100">
                            <div class="row align-items-center small-box">
                                <div class="col-5"><img src="{{asset(env('APP_ASSETS').'/'.'assets/images/mail.png')}}" class="w-100" alt="عدد الزائرين"></div>
                                <div class="col-7">
                                    <h6 class="orange">رسائل جديدة</h6>
                                    <span>{{$contacts}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 p-1">
                        <div class="rounded-3 bg-black p-3 h-100 charts">
                            <h3 class="text-center"><i class="fa-solid fa-message me-3"></i>الرسائل الشهرية</h3>
                            <div class="w-100 chart-container">
                               
                                <canvas id="circlechart" class="w-100 h-100">

                                </canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-7 p-1">
                        <div class="rounded-3 bg-black p-2 h-100 charts">
                            <h3 class="text-center"><i class="fa-regular fa-eye me-3"></i>الزيارات اليومية</h3>
                            <div class="w-100 chart-container">
                                <canvas id="linechart" class="w-100 h-100"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 p-1">
                       
                        <div class="rounded-3 bg-black p-3 charts">
                            <h3 class="text-center"><i class="fa-solid fa-check-double me-3"></i>استشارة ناجحة</h3>
                            <div class="w-100 chart-container">
                                <canvas id="barchart" class="w-100 h-100"></canvas>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div id="newArticle" class="p-3">
                <div class="row">
                    <div class="col-md-12 p-1">
                        <div class="rounded-3 bg-black p-3">
                            <h3><i class="fa-solid fa-pen-nib me-2"></i>مقال جديد</h3>
                            <form action="{{route('contents.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="">عنوان المقال</label>
                                        <input type="text" name="title" class="form-control" placeholder="عنوان المقال">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="services">الخدمة التابع لها</label>
                                        <select name="service_id" class="form-control">
                                            @foreach ($services as $service)
                                            <option value="{{$service->id}}">{{$service->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="image" class="mb-1">صورة المقال</label>
                                        <input type="file" id="image" name="image" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="yt_video" class="mb-1">فيديو يوتيوب</label>
                                        <input type="text" id="yt_video" name="yt_video" class="form-control" placeholder="URL">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="intro">مقدمة المقال</label>
                                        <input type="text" name="intro" id="intro" class="form-control" placeholder="مقدمة للمقال">
                                    </div>
                                    <div class="col-md-12 mb-4">
                                       <textarea id="articledata" name="content"></textarea>
                                    </div>
                                </div>
                                
                                <button class="btn btn-darkgold">نشر المقال</button> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="publishedArticles" class="p-3">
                <div class="row">
                    <div class="col-md-12 p-1">
                        <div class="rounded-3 bg-black p-3">
                            <h3><i class="fa-solid fa-newspaper me-2"></i>المقالات المنشورة</h3>
                            <div class="w-100 table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">عنوان المنشور</th>
                                            <th scope="col">محتوي المنشور</th>
                                            <th scope="col">الخدمة التابع لها</th>
                                            <th scope="col">تاريخ النشر</th>
                                            <th scope="col">تعديل</th>
                                            <th scope="col">مسح</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($contents as $content)
                                        <tr>
                                            <td>{{$content->title}}</td>
                                            <td>
                                                <a href="{{route('articale.show',$content->slug)}}" target="_blank">
                                                    <button class="btn btn-info">
                                                        عرض المنشور
                                                    </button>
                                                </a>
                                            </td>
                                            <td>{{$content->service->name}}</td>
                                            <td> 
                                                {{date('Y/m/d H:m A', strtotime($content->created_at));}}
                                            </td>
                                            <td>
                                                <a href="{{route('services.show',$content->service->id)}}">
                                                    <button class="btn btn-warning">
                                                        تعديل <i class="fa-solid fa-pen-nib"></i>
                                                    </button>
                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{route('contents.destroy',$content->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger">
                                                        حذف  <i class="fa-solid fa-trash"></i>
                                                     </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                            
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="bookedConsultations" class="p-3">
                <div class="row">
                    <div class="col-md-12 p-1">
                        <div class="rounded-3 bg-black p-3">
                            <h3><i class="fa-solid fa-calendar-check me-2"></i>الاستشارات المحجوزة</h3>
                            <div class="w-100 table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">الاسم</th>
                                            <th scope="col">رقم الهاتف</th>
                                            <th scope="col">البريد الالكتروني</th>
                                            <th scope="col">تاريخ حجز الاستشارة</th>
                                            <th scope="col">تاريخ مقابلة الاستشارة</th>
                                            <th scope="col">حالة الدفع</th>
                                            <th>رابط الاجتماع</th>
                                            <th>حالة الاستشارة</th>
                                            <th scope="col">مسح</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($consultations_bookinged as $consultation_bookinged)
                                            <tr>
                                                <td>{{$consultation_bookinged->name}}</td>
                                                <td>{{$consultation_bookinged->phone}}</td>
                                                <td>{{$consultation_bookinged->email}}</td>

                                                <td>{{$consultation_bookinged->created_at->format('Y/m/d ( g:i A )')}}</td>

                                                <td>{{$consultation_bookinged->from_time}} @if($consultation_bookinged->to_time) الي {{$consultation_bookinged->to_time}} @endif</td>
                                                <td>
                                                    @if ($consultation_bookinged->payment_status =='paid')
                                                        <span style="color:rgb(30, 182, 0)">مدفوعة</span>
                                                    @elseif($consultation_bookinged->payment_status =='failed')
                                                        <span style="color:rgb(232, 16, 19)"> فاشلة</span>
                                                    @else
                                                        <span style="color:rgb(255, 205, 57)">غير مدفوعة</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{route('consultation.user.update.meeting.link',$consultation_bookinged->id)}}" method="POST" style="display: table-cell">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="text" class="form-control mb-2" name="meeting_link" placeholder="الرابط"  value="{{$consultation_bookinged->meeting_link}}">
                                                        <button  type="submit" class="btn btn-darkgold p-1">ارسال</button>
                                                    </form>
                                                </td>
                                                  <td>
                                                    <form action="{{route('consultation.user.update.status',$consultation_bookinged->id)}}" method="POST" style="display: table-cell">
                                                        @csrf
                                                        @method('PUT')
                                                        <select name="status" class="form-control mb-2">
                                                            <option value="pending" @if($consultation_bookinged->status == 'pending') selected @endif>غير محدد</option>
                                                            <option value="success" @if($consultation_bookinged->status == 'success') selected @endif>ناجحة</option>
                                                            <option value="failed" @if($consultation_bookinged->status == 'failed') selected @endif>فاشلة</option>
                                                        </select>
                                                        <button  type="submit" class="btn btn-darkgold p-1">حفظ</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="{{route('consultation.user.delete.consultation',$consultation_bookinged->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">حذف</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="appointmentAvailable" class="p-3">
                <div class="row">
                    <div class="col-md-6 p-1">
                        <div class="rounded-3 bg-black p-3">
                            <form  action="" method="POST" id="date-form">
                                @csrf
                                <h4><i class="fa-regular fa-calendar-plus me-2"></i>إضافة موعد</h4>
                                <input type="datetime-local" id="date" name="date" class="form-control mb-3" >
                                <button type="submit" class="btn btn-darkgold">إضافة موعد<i class="fa-regular fa-floppy-disk ms-2"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 p-1">
                        <div class="rounded-3 bg-black p-3">
                            <div class="w-100 table-responsive">
                                <h4><i class="fa-solid fa-calendar-days me-2"></i>جميع الاوقات</h4>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">م</th>
                                            <th scope="col">اليوم</th>
                                            <th scope="col">السنه</th>
                                            <th scope="col">الشهر</th>
                                            <th scope="col">مسح</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($dates as $date) --}}
                                            <tr>
                                                {{-- <td>{{ date('h A', strtotime($date->date))}} </td>
                                                <td>{{ date('d', strtotime($date->date))}} </td>
                                                <td>{{ date('Y', strtotime($date->date))}} </td>
                                                <td>{{ date('m', strtotime($date->date))}} </td>
                                                <td>
                                                    <form action="{{route('admin.date.destroy',$date->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td> --}}

                                            </tr>
                                        {{-- @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="messages" class="p-3">
                <div class="row">
                    <div class="col-md-12 p-1">
                        <div class="rounded-3 bg-black p-3">
                            <h3><i class="fa-solid fa-message me-2"></i>الرسائل</h3>
                            <div class="w-100 table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">الاسم</th>
                                            <th scope="col">رقم الهاتف</th>
                                            <th scope="col">البريد الالكتروني</th>
                                            <th scope="col">عنوان الرسالة</th>
                                            <th scope="col">الرسالة</th>
                                            <th scope="col">الحالة</th>
                                            <th scope="col">مسح</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allContacts as $contact)
                                            
                                        <tr>
                                            <td>{{$contact->name}}</td>
                                            <td>{{$contact->phone}}</td>
                                            <td>{{$contact->email}}</td>
                                            <td>{{$contact->subject}}</td>
                                            <td>{{$contact->content}}</td>
                                            <td>
                                                <form action="{{route('update.contact',$contact->id)}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="status" class="form-control">
                                                        <option value="pending" @if($contact->status=='pending') selected @endif>جديد</option>
                                                        <option value="as_readed" @if($contact->status=='as_readed') selected @endif>مقروءة</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-darkgold">
                                                        حفظ
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{route('delete.contact',$contact->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button  type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="changePass" class="p-3">
                <div class="row">
                    <div class="col-md-12 p-1">
                        <div class="rounded-3 bg-black p-3">
                            <h3><i class="fa-solid fa-unlock me-2"></i>تغيير كلمة السر</h3>
                            <div class="formWidth">
                                <form action="{{route('admin.change.password')}}" method="POST" id="changePass" class="m-auto">
                                    @csrf
                                    <input type="password" class="form-control" name="old_password" placeholder="ادخل كلمة السر الحالية" />
                                    <input type="password" class="form-control" name="password" placeholder="ادخل كلمة السر الجديدة" />
                                    <div class="invalid-feedback mb-2" id="newPasswordError">برجاء إدخال كلمة سر قوية لا تقل عن 8 احرف وتحتوي على حرف capital</div>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="اعد ادخال كلمة السر الجديدة" />
                                    <div class="invalid-feedback mb-2" id="renewPasswordError">كلمتي السر غير متطابقين</div>
                                    <button class="btn btn-darkgold" id="submitButton">تغيير كلمة السر</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const consultionBookingsGroupByMonthes = "{{$consultion_bookingsGroupByMonthes}}";
            const monthMessages = "{{$monthMessages}}";
            const weekViewsGroupBy = "{{$weekViewsGroupBy}}";
        </script>
        <script>
            tinymce.init({
              selector: 'textarea',
              directionality : "rtl",
              plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
              toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            });
        </script>
          
        <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/jquery.min.js')}}"></script>
        <script src="{{asset(env('APP_ASSETS').'/'.'assets/fontawesome/js/all.min.js')}}"></script>
        <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/dashboard/adminpage.js')}}"></script>
        
    </body>
</html>
