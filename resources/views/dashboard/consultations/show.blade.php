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
  <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/dashboard/consultations/show.css')}}" />
  
  <link rel="icon" href="{{asset(env('APP_ASSETS').'/'.'assets/images/new.png')}}" type="image/png">
  <title>{{$consultation->name}}</title>
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
    @error('time.0')
        <div class="erroralert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            {{$message}}
        </div>  
    @enderror
    @error('from_time.*')
        <div class="erroralert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            {{$message}}
        </div>  
    @enderror

  <div class="main">
    <div class="container">
      <div class="main-sub row align-items-center pt-5">
        </div>
        <div class="table-container mt-4">

          <div class="mb-2 d-flex justify-content-between align-items-center routes">
                  
                  <div class="d-flex">

                      <a href="{{route('consultations.index')}}">
                          <div class="text-secondary m-2">
                              <button class="btn btn-darkgold">
                                <i class="fa-solid fa-handshake"></i> جميع الاستشارات 
                              </button>
                          </div>
                      </a>
                      <h2 class="m-2">أسم الاستشارة : {{$consultation->name}}</h2>
                  </div>

                  <div>
                      <a href="{{route('admin.index')}}">
                          <button class="btn btn-lightgold">
                          <i class="fa-solid fa-gauge"></i>  لوحة التحكم 
                          </button>
                      </a>
                  </div>
                
          </div>

         

          <div class="add-new-date">
            <button class="btn btn-lightgold add-new-date-btn ms-2" data-id="{{$consultation->id}}">
              أضافة تاريخ جديد
            </button>
          </div>  


          <br>
           <div class="add-new-date-form-container" data-id="{{$consultation->id}}">

            <div class="add-new-date-form-close-btn" data-id="{{$consultation->id}}">
              <i class="fa-solid fa-xmark"></i>
            </div>

            <div class="add-new-date-form-content">
              <form class="w-50 d-flex flex-column align-items-center justify-content-center" action="{{route('consultation.add.date',$consultation->id)}}" method="POST">
                @csrf
                <div>
                  <input type="date" class="form-control" name="date" required>
                </div>

                <div>
                  <button type="submit" class="btn btn-darkgold">
                      اضاف الان
                  </button>
                </div>

              </form>
            </div> 
           </div> 


          <table id="mytable" class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
              <tr class="header-row">
                  <th>التاريخ</th>
                  <th>السنة</th>
                  <th>الشهر</th>
                  <th>اليوم</th>
                  <th>حالة الوقت</th>
                  <th>تعديل الحالة</th>
                  <th>حذف</th>
                  <th>ادارة توقيت التاريخ</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($consultation->dates as $date)
              <tr>
                <td>{{date('Y/m/d', strtotime($date->date));}}</td>
                <td>{{date('Y', strtotime($date->date));}}</td>
                <td>{{date('M m', strtotime($date->date));}}</td>
                <td>{{date('d D', strtotime($date->date));}}</td>
                <td>
                  @if ($date->status =="active")
                  <span class="date-active-status">
                      <i class="fa-solid fa-chart-line"></i>  نشط
                  </span>
                  @else
                  <span class="date-archived-status">
                      <i class="fa-solid fa-folder"></i> مؤرشف 
                  </span>
                  @endif
                </td>
                <td>
                  <form action="{{route('consultation.update.date',$date->id)}}" class="edit-form-box" method="POST" class="d-flex align-items-center">
                      @csrf
                      @method('put')
                      <select name="status" class="form-control">
                          <option value="active" @if($date->status =='active') selected   @endif>
                              نشط
                          </option>
                          <option value="archived" @if($date->status =='archived') selected   @endif>
                              مؤرشف
                          </option>
                      </select>

                      <button type="submit" class="btn btn-success">حفظ</button>
                  </form>
                </td>
                <td class="d-flex align-items-center justify-content-center">
                  <form action="{{route('consultation.delete.date',$date->id)}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">
                        <i class="fa-solid fa-trash"></i> حذف
                        </button>
                  </form>
                </td>
                <td class="text-center">
                  <a class="btn btn-darkgold" href="{{route('consultation.date.edit',$date->id)}}">
                    ادارة التوقيت
                  </a>
                </td>
{{-- 
                <td style="text-align: center;">
                  <button type="button" class="btn btn-warning edit-time-btn" data-id="{{$date->id}}">
                    <i class="fa-regular fa-clock"></i>
                  </button>

                  <div class="time-form-container" data-id="{{$date->id}}">
                    <div class="time-form-close-btn"  data-id="{{$date->id}}"> 
                      <i class="fa-solid fa-xmark"></i>
                    </div>
                    <div class="time-form-content">
                      <div class="time-form-form">

                        <h5>التاريخ : {{date('Y/m/d', strtotime($date->date));}}</h5>
                        
                           <form action="{{route('consultation.times.updateorcreate',$date->id)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <div>
                              <p>توقيت الاستشارة</p>
                            </div>

                            <div id="genrate_time">
                              @foreach ($date->times as $time)

                                <div class="inputs-container" data-id="{{$time->id}}">
                                  <div class="delete-time-btn" data-id="{{$time->id}}">
                                    delete
                                  </div>

                                  <div class="time-inputs"> 
                                    <input type="time" name="from_time[]" value="{{$time->from_time}}" class="form-control">
                                    <input type="time" name="to_time[]" value="{{$time->to_time}}" class="form-control">
                                  </div>
                                </div>
                              @endforeach
                            </div>

                             <div>
                              <p id="genrate_time_btn">إضافة توقيت</p>
                            </div> 

                            <div>
                              <button type="submit" class="btn btn-darkgold">حفظ</button>
                            </div>
                            

                           </form>


                      </div>
                     
                    </div> 
                  </div>

                </td> --}}
              </tr>
              @empty
              <h3 class="empty-consultation">لايوجد مواعيد لهذا الاستشارة حتي الان</h3>
              @endforelse
            </tbody>
          </table>
              {{-- {{$allConsultations->links()}} --}}
        </div>
      </div>
    </div>
  </div>
  {{-- <script>
    // Access the button element
    var genrateTimeBtn = document.getElementById("genrate_time_btn");
     var genrateTime = document.getElementById("genrate_time");

     genrateTimeBtn.onclick = function(){
             // Create a new input element
             var fromTimeInput = document.createElement("input");
                 fromTimeInput.type = "time";
                 fromTimeInput.name="from_time[]";
                 fromTimeInput.classList.add("form-control");
                 fromTimeInput.classList.add("mb-3");

              // Create a new input element
              var toTimeInput = document.createElement("input");
                  toTimeInput.type = "time";
                  toTimeInput.name="to_time[]";
                  toTimeInput.classList.add("form-control");
                  toTimeInput.classList.add("mb-3");

              var createDiv = document.createElement('div');
                  createDiv.classList.add('time-inputs');
                  createDiv.appendChild(fromTimeInput);
                  createDiv.appendChild(toTimeInput);

             // Append the input element to the container
             genrateTime.appendChild(createDiv);

     }
  </script> --}}

  <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/jquery.min.js')}}"></script>
  <script src="{{asset(env('APP_ASSETS').'/'.'assets/fontawesome/js/all.min.js')}}"></script>
  <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/bootstrap.bundle.min.js')}}"></script>
 <script>
      $(".add-new-date-btn").on("click", function() {
        let id = $(this).data('id');
        $('.add-new-date-form-container[data-id='+id+']').toggle();
      });
      $(".add-new-date-form-close-btn").on("click", function() {
        let id = $(this).data('id');
        $('.add-new-date-form-container[data-id='+id+']').toggle();
      });

      // $(".delete-time-btn").on("click", function() {
      //   let id = $(this).data('id');
      //   $('.inputs-container[data-id='+id+']').remove();
      // });



      // $(".time-form-close-btn").on("click", function() {
      //   let id = $(this).data('id');
      //   $('.time-form-container[data-id='+id+']').toggle();
      // });
       
       
 </script>
</body>
</html>


