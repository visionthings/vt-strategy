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
  <title>جميع الاستشارات</title>
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
              @error('name')
              <div class="erroralert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                {{$message}}
              </div>  
              @enderror
              @error('price')
              <div class="erroralert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                {{$message}}
              </div>  
              @enderror
              @error('tax')
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
              {{-- @error('date.0')
              <p class="erroralert">{{$message}}</p>  
              @enderror --}}
  <div class="main">
    <div class="container">
      <div class="main-sub row align-items-center pt-4">
        </div>
        <div class="table-container mt-5">

          <div class="mb-2 d-flex justify-content-between align-items-center routes">

            <div class="d-flex">

                <a href="{{route('consultations.create')}}">
                  <div class="text-secondary m-2">
                      <button class="btn btn-darkgold">
                        <i class="fa-solid fa-plus"></i> إضافة  
                      </button>
                  </div>
                </a>
               <h2 class="m-2">إضافة استشارة جديدة</h2>

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
                  <th>أسم الاستشارة</th>
                  <th>بواسطة</th>
                  <th>سعر الاستشارة</th>
                  <th>نسبة الضريبة</th>
                  <th>سعر الاستشارة بعد الضريبة</th>
                  <th>حالة الاستشارة</th>
                  <th>تاريخ إنشاء الاسشتارة</th>
                  <th>تعديل</th>
                  <th>تفاصيل</th>
                  <th>حذف الاستشارة</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($allConsultations as $consultation)
              <tr>
                <td>{{$consultation->name}}</td>
                <td>{{$consultation->admin->fullname}}</td>
                <td>{{$consultation->price}}</td>
                <td>@if($consultation->tax) %{{$consultation->tax}} @else __ @endif</td>
                <td>
                  @if($consultation->tax_price)
                    {{$consultation->tax_price}}
                    @else
                    {{$consultation->price}}
                  @endif
                </td>
                <td>
                  @if ($consultation->status =='active')
                    <span class="active_status">
                      <i class="fa-solid fa-chart-line"></i> نشطة
                    </span>
                    @else
                    <span class="arcived_status">
                      <i class="fa-solid fa-folder"></i> مؤرشفة 
                    </span>
                  @endif
                </td>
                <td>{{$consultation->created_at->format('Y/m/d H:m A')}}</td>
                <td>
                  <button class="btn btn-warning edit_consultation_btn" data-id="{{$consultation->id}}">
                    <i class="fa-regular fa-pen-to-square"></i> تعديل الاستشارة
                  </button>

                  <div class="edit-consultation-container" data-id="{{$consultation->id}}"> 
                    <div class="edit-consultation-content">
                      <div class="close-btn" data-id="{{$consultation->id}}">
                        <span>
                          <i class="fa-solid fa-xmark"></i>
                        </span>
                      </div>
                      <div class="edit-consultation">

                        <form action="{{route('consultations.update',$consultation->id)}}" method="POST">
                          @csrf
                          @method('put')
                          <div>
                            <label for="name">أسم الاستشارة</label>
                            <input type="text" name="name" id="name" class="form-control mb-3" value="{{$consultation->name}}" placeholder="أسم الاستشارة">
                          </div>
                      

                          <div>
                              <label for="price">سعر الاستشارة</label>
                              <input type="text" name="price" id="price" class="form-control mb-3" value="{{$consultation->price}}" placeholder="سعر الاستشارة">
                          </div>
                          <div class="tax">
                              <div class="form-check form-switch d-flex align-items-center">
                                <input class="form-check-input me-3" type="checkbox" @if($consultation->tax) checked @endif value="15" name="tax" id="tax">
                                <label class="form-check-label" for="tax">إضافة ضريبة</label>
                            </div>
                          </div>

                          <div>
                              <label for="status">حالة الاستشارة</label>
                              <select name="status" class="form-control mb-3">
                                  <option value="active" @if($consultation->status =="active") selected @endif>نشطة</option>
                                  <option value="archived" @if($consultation->status =="archived") selected @endif>مؤرشفة</option>
                              </select>
                          </div>

                          {{-- <div id="genrate_date" data-id="{{$consultation->id}}">
                              <label for="date">تواريخ الاستشارة</label>
                              @foreach ($consultation->dates as $date)
                               <div class="date-input-container mb-2">
                                    <button type="button" class="delete-date-input btn btn-danger" data-id="{{$date->id}}">
                                      <i class="fa-solid fa-trash me-2"></i>حذف
                                    </button>
                                    @if ($date->status =="active")
                                    <span class="date-active-status status" data-id="{{$date->id}}">نشط</span>
                                    @else
                                    <span class="date-archived-status status" data-id="{{$date->id}}">مؤرشف</span>
                                    @endif
                               </div>


                               <input type="date" name="date[]" class="date-input form-control mb-3" data-id="{{$date->id}}" value="{{$date->date}}">

                              @endforeach
                          </div>
                          <p id="genrate_date_btn" data-id="{{$consultation->id}}">إضافة موعد</p> --}}


                          <div>
                              <button type="submit" class="btn btn-darkgold">حفظ</button>
                          </div>

                        </form>
                      </div>
                    </div>
                  </div>

                </td>
                <td>
                  <a href="{{route('consultations.show',$consultation->id)}}">
                    <button class="btn btn-info">
                      <i class="fa-regular fa-eye"></i> عرض التفاصيل 
                    </button>
                  </a>
                </td>
                <td>
                  <form action="{{route('consultations.destroy',$consultation->id)}}" method="POST" class="d-flex align-items-center justify-content-center">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                  </form>
                </td>
              </tr>
              @empty
              <h3 class="empty-consultation">لايوجد استشارات حتي الان</h3>
              @endforelse
            </tbody>
          </table>
              {{$allConsultations->links()}}
        </div>
      </div>
    </div>
  </div>

  <script>
     

    // // Access the button element
    var genrateDateBtn = document.querySelector("#genrate_date_btn");
    var genrateDate = document.querySelector("#genrate_date");

    genrateDateBtn.onclick = function(){
    
            // Create a new input element
            var datetimeInput = document.createElement("input");
                datetimeInput.type = "date";
                datetimeInput.name="date[]";
                datetimeInput.classList.add("form-control");
                datetimeInput.classList.add("mb-3");

            // Append the input element to the container
                genrateDate.appendChild(datetimeInput);
    }
  </script>


    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/jquery.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/fontawesome/js/all.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/bootstrap.bundle.min.js')}}"></script>

    <script>
      $(".edit_consultation_btn").on("click", function() {
        let id = $(this).data('id');
        $('.edit-consultation-container[data-id='+id+']').toggle();
      });
      


      $(".close-btn").on("click", function() {
        let id = $(this).data('id');
        $('.edit-consultation-container[data-id='+id+']').toggle();
      });

      $(".delete-date-input").on("click", function() {
        let id = $(this).data('id');
        $('.date-input[data-id='+id+']').remove();
        $('.delete-date-input[data-id='+id+']').remove();
        $('.status[data-id='+id+']').remove();
      });
     
     </script>

</body>
</html>
  
