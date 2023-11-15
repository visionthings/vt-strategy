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
    <title>إضافة استشارة جديدة</title>
</head>
<body>
    <div class="add-consultation-container">
        
        <div class="add-consultation-routes"> 
            <a href="{{route('consultations.index')}}">
                <button class="btn btn-darkgold">
                    <i class="fa-solid fa-handshake"></i> جميع الاستشارات 
                </button>
            </a>
            <a href="{{route('admin.index')}}">
                <button class="btn btn-lightgold">
                    <i class="fa-solid fa-gauge"></i> لوحة التحكم 
                </button>
            </a>
        </div>

        <div class="add-consultation-content">

            <div class="add-consultation">
                <form action="{{route('consultations.store')}}" method="POST">
                    @csrf
                    <div>
                        
                        <label for="name">أسم الاستشارة</label>
                        @error('name')
                          <p class="alert alert-danger">{{$message}}</p>  
                        @enderror
                        <input type="text" name="name" id="name" class="form-control mb-3" placeholder="أسم الاستشارة">
                    </div>
                    
                    <div>
                        <label for="price">سعر الاستشارة</label>
                        @error('price')
                            <p class="alert alert-danger">{{$message}}</p>  
                        @enderror
                        <input type="text" name="price" id="price" class="form-control mb-3" placeholder="سعر الاستشارة">
                    </div>
                    <div class="tax">
                        @error('tax')
                        <p class="alert alert-danger">{{$message}}</p>  
                        @enderror
                        <div class="form-check form-switch d-flex align-items-center">
                            <input class="form-check-input me-3" type="checkbox" value="15" name="tax" id="tax">
                            <label class="form-check-label" for="tax">إضافة ضريبة</label>
                        </div>
                    </div>
                    <div>
                        <label for="status">حالة الاستشارة</label>
                        @error('status')
                        <p class="alert alert-danger">{{$message}}</p>  
                        @enderror
                        <select name="status" class="form-control mb-3">
                            <option value="active">نشطة</option>
                            <option value="archived">مؤرشفة</option>
                        </select>
                    </div>
                    {{-- <div class="con-days">
                        <input type="checkbox" name="days[]" id="saturday">
                        <label for="saturday">السبت</label>
                        <input type="checkbox" name="days[]" id="sunday">
                        <label for="sunday">الاحد</label>
                        <input type="checkbox" name="days[]" id="monday">
                        <label for="monday">الاثنين</label>
                        <input type="checkbox" name="days[]" id="tuesday">
                        <label for="tuesday">الثلاثاء</label>
                        <input type="checkbox" name="days[]" id="wednesday">
                        <label for="wednesday">الاربعاء</label>
                        <input type="checkbox" name="days[]" id="thursday">
                        <label for="thursday">الخميس</label>
                        <input type="checkbox" name="days[]" id="friday">
                        <label for="friday">الجمعه</label>
                        
                    </div> --}}
                    <div id="genrate_date">
                        <label for="date">تاريخ الاستشارة</label>
                        @error('date.0')
                        <p class="error-alert-danger">{{$message}}</p>  
                        @enderror
                        <input type="date" class="form-control mb-3" name="date[]">
                    </div>
                    <p id="genrate_date_btn">إضافة تاريخ</p>
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
    <script>
        // Access the button element
        var genrateDateBtn = document.getElementById("genrate_date_btn");
        var genrateDate = document.getElementById("genrate_date");

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
</body>
</html>