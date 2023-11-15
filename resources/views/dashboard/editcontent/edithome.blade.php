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
    <title>تعديل الصفحة الرئيسية</title>
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
                        <li class="nav-item active">
                          <a class="nav-link" aria-current="page" href="{{route('home.data.view')}}">الصفحة الرئيسية</a>
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
            
              <h3 class="mt-3 text-center">تعديل الصفحة الرئيسية</h3>
                <div class="main p-4">  

                  <form action="{{route('home.governances.update',$homePageData->id)}}" method="POST">
                      @csrf
                      @method('PUT')
                        <h5>الحوكمة</h5>
                      @if(Session::get('success'))
                      <div class="successalert">
                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                          {{Session::get('success')}}
                      </div>
                      @endif
                      @error('section_description')
                        <p class="alert alert-danger">{{$message}}</p>
                      @enderror
                      @error('description_one')
                        <p class="alert alert-danger">{{$message}}</p>
                      @enderror
                      @error('description_two')
                        <p class="alert alert-danger">{{$message}}</p>
                      @enderror
                      @error('description_three')
                        <p class="alert alert-danger">{{$message}}</p>
                      @enderror
                      @error('status')
                        <p class="alert alert-danger">{{$message}}</p>
                      @enderror
                      {{-- <div class="col-md-12 mb-2">
                        <label for="secheader">عنوان السكشن</label>
                        <input type="text" id="secheader" class="form-control" placeholder="عنوان السكشن">
                      </div> --}}
                      <div class="col-md-12 mb-2">
                        <label for="secparagraph">الوصف الخاص بالسكشن</label>
                        <input type="text" id="secparagraph" name="section_description" class="form-control" placeholder="وصف السكشن" value="{{old('section_description',$homePageData->section_description)}}">
                      </div>
                      <div class="d-flex p-2">
                        <div class="col-4 mb-2 p-2">
                          <label for="box1">1</label>
                          <textarea id="box1" name="description_one" class="form-control" placeholder="وصف اول جزء">{{old('description_one',$homePageData->description_one)}}</textarea>
                        </div>
                        <div class="col-4 mb-2 p-2">
                          <label for="box2">2</label>
                          <textarea  id="box2" name="description_two" class="form-control" placeholder="وصف ثاني جزء"> {{old('description_two',$homePageData->description_two)}}</textarea>
                        </div> 
                        <div class="col-4 mb-2 p-2">
                          <label for="box3">3</label>
                          <textarea  id="box3" name="description_three" class="form-control" placeholder="وصف ثالث جزء">{{old('description_three',$homePageData->description_three)}}</textarea>
                        </div>
                      </div>
                      <div class="col-4 mb-2 p-2">
                          <p>الحالة</p>
                          <input type="radio" id="active" name="status" value="active" @if ($homePageData->status =='active') checked @endif>
                          <label for="active">مفعل</label>
                          <input type="radio" id="archived" name="status"  value="archived" @if ($homePageData->status =='archived') checked @endif>
                          <label for="archived">غير مفعل</label>
                        </div>
                      
                      <div class="col-md-12">
                        <button class="btn btn-darkgold"><i class="fa-solid fa-floppy-disk me-2"></i>حفظ التعديلات</button>
                      </div>
                     
                  </form>
                  <hr>

                  <form action="{{route('home.homeconsultationmsg.update',$homeconsultationmsg->id)}}" method="POST">
                   @csrf
                   @method('PUT')
                    <h5>الاستشارات</h5>
                    {{-- <div class="col-md-12 mb-2">
                      <label for="consulthead">عنوان السكشن</label>
                      <input type="text" id="consulthead" class="form-control" placeholder="عنوان السكشن">
                    </div> --}}
                    <div class="col-md-12 mb-2">
                      <label for="consultation_msg">وصف السكشن</label>
                      <textarea name="consultation_msg" id="consultation_msg" class="form-control" placeholder="وصف السكشن">{{old('consultation_msg',$homeconsultationmsg->consultation_msg)}}</textarea>
                    </div>

                    <div class="col-md-12">
                      <button class="btn btn-darkgold"><i class="fa-solid fa-floppy-disk me-2"></i>حفظ التعديلات</button>
                    </div>
                  </form>
                  <hr>

                  {{-- <h5 class="customer-feedback">آراء العملاء</h5> 
                  @foreach ($customerFeedBackDatas as  $customerFeedBackData)
                    <form action="{{route('home.customer.feedback.update',$customerFeedBackData->id)}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                        <div id="customer_container">
                            <div class="customer-feedback-inputs">
                                <div class="customer-avatar-container">
                                  <img src="{{$customerFeedBackData->getFirstMediaUrl('customer')}}" alt="Customer Avatar">
                                </div>
                                @error('avatar')
                                <p class="alert alert-danger">{{$message}}</p>
                                @enderror
                                <div class="col-md-12 mb-2">
                                  <label for="avatar">صورة العميل يفضل png</label>
                                  <input type="file" accept="image/png, image/jpeg" id="avatar" name="avatar" class="form-control">
                                </div>
                                @error('name')
                                <p class="alert alert-danger">{{$message}}</p>
                                @enderror
                                <div class="col-md-5 mb-2">
                                  <label for="custom1name">اسم العميل</label>
                                  <input type="text" id="custom1name" name="name" class="form-control" placeholder="اسم العميل" value="{{old('name',$customerFeedBackData->name)}}">
                                </div>
                                @error('rate')
                                <p class="alert alert-danger">{{$message}}</p>
                                @enderror
                                <div class="col-md-2 mb-2">
                                  <label for="rate1">التقييم</label>
                                  <select name="rate" id="rate1" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                  </select>
                                </div>
                                @error('job_name')
                                <p class="alert alert-danger">{{$message}}</p>
                                @enderror
                                <div class="col-md-5 mb-2">
                                  <label for="job_name">المسمي الوظيفي</label>
                                  <input type="text" id="job_name" name="job_name" class="form-control" placeholder="المسمي الوظيفي" value="{{old('job_name',$customerFeedBackData->job_name)}}">
                                </div>
                                @error('comment')
                                <p class="alert alert-danger">{{$message}}</p>
                                @enderror
                                <div class="col-md-12 mb-2">
                                  <label for="comment">التقييم والتعليق</label>
                                  <textarea name="comment" id="comment" class="form-control" placeholder="التعليق">{{old('comment',$customerFeedBackData->comment)}}</textarea>
                                </div>
                                @error('rate')
                                <p class="alert alert-danger">{{$message}}</p>
                                @enderror
                                <div class="col-md-2 mb-2">
                                  <label for="status">الحالة</label>
                                  <select name="status" id="status" class="form-control">
                                    <option value="active">اول</option>
                                    <option value="no_active">عادي</option>
                                  </select>
                                </div>
                            </div>
                        </div>
                        
                      

                        <div class="col-md-12">
                          <button class="btn btn-darkgold"><i class="fa-solid fa-floppy-disk me-2"></i>حفظ التعديلات</button>
                        </div>
                    </form>
                    <hr>
                  @endforeach --}}

                          
                        {{-- <div class="add-customer">
                          <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-2"></i>
                            اضافة عميل جديد
                          </button>
                        </div> --}}

                      {{-- <hr>

                      <h6>ثاني عميل</h6>
                      <div class="col-md-12 mb-2">
                        <label for="custom2">صورة العميل يفضل png</label>
                        <input type="file" accept="image/png, image/jpeg" id="custom2" name="custom2" class="form-control">
                      </div>
                      <div class="col-md-5 mb-2">
                        <label for="custom2name">اسم العميل</label>
                        <input type="text" id="custom2name" class="form-control" placeholder="اسم العميل">
                      </div>
                      <div class="col-md-2 mb-2">
                        <label for="rate2">التقييم</label>
                        <select name="" id="rate2" class="form-control">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                      <div class="col-md-5 mb-2">
                        <label for="work2">المسمي الوظيفي</label>
                        <input type="text" id="work2" class="form-control" placeholder="المسمي الوظيفي">
                      </div>
                      <div class="col-md-12 mb-2">
                        <label for="rateparg2">التقييم والتعليق</label>
                        <textarea name="rateparg2" id="rateparg2" class="form-control" placeholder="التعليق"></textarea>
                      </div>
                      <hr>

                      <h6>ثالث عميل</h6>
                      <div class="col-md-12 mb-2">
                        <label for="custom3">صورة العميل يفضل png</label>
                        <input type="file" accept="image/png, image/jpeg" id="custom3" name="custom3" class="form-control">
                      </div>
                      <div class="col-md-5 mb-2">
                        <label for="custom3name">اسم العميل</label>
                        <input type="text" id="custom3name" class="form-control" placeholder="اسم العميل">
                      </div>
                      <div class="col-md-2 mb-2">
                        <label for="rate3">التقييم</label>
                        <select name="" id="rate3" class="form-control">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                      <div class="col-md-5 mb-2">
                        <label for="work3">المسمي الوظيفي</label>
                        <input type="text" id="work3" class="form-control" placeholder="المسمي الوظيفي">
                      </div>
                      <div class="col-md-12 mb-2">
                        <label for="rateparg3">التقييم والتعليق</label>
                        <textarea name="rateparg3" id="rateparg3" class="form-control" placeholder="التعليق"></textarea>
                      </div> --}}
                    <h5 class="customer-feedback">آراء العملاء</h5> 
                    <table class="w-100 rates mt-3">
                      <thead>
                        <tr style="background-color: var(--lightgold);color:var(--black)">
                          <td>الأسم</td>
                          <td>المسمي الوظيفي</td>
                          <td>التقييم</td>
                          <td>الحالة</td>
                          <td>عرض</td>
                          <td>حذف</td>
                        </tr>
                      </thead>
                      <tbody>
                       @forelse ($customersRate as $customerRate)
                        <tr>
                          <td>{{$customerRate->name}}</td>
                          <td>{{$customerRate->job_name}}</td>
                          <td>{{$customerRate->rate}}</td>
                          <td>
                            @if($customerRate->status =='active') 
                            مفعل
                            @else 
                            غير مفعل
                            @endif
                          </td>
                          <td>
                            <form action="{{route('customer.rate.update',$customerRate->id)}}" method="POST">
                              @csrf
                              @method('PUT')
                              <div class="form-check form-switch d-flex justify-content-center">
                                <select name="status"  class="form-control w-50">
                                  <option value="active" @if($customerRate->status =='active') selected @endif>مفعل</option>
                                  <option value="no_active" @if($customerRate->status =='no_active') selected @endif>غير مفعل</option>
                                </select>
                                <button type="submit" class="btn btn-darkgold">تعديل</button>
                              </div>
                            
                            </form>
                          </td>
                          <td>
                            <form action="{{route('customer.rate.delete',$customerRate->id)}}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                          </td>
                        </tr>
                        @empty
                         <tr>
                          <td colspan="6"><h4>لا يوجد اراء حتي الان</h4></td>
                         </tr>
                        @endforelse 
                        

                      </tbody>
                    </table>  

          </div>
      </div>
        
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/jquery.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/fontawesome/js/all.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/bootstrap.bundle.min.js')}}"></script>
  
</body>
</html>


