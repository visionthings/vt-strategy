<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/fontawesome/css/all.min.css')}}" />
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/bootstrap.rtl.css')}}" />
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/mainstyle.css')}}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"/>
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/dashboard/consultations/date.css')}}" />
    
    <link rel="icon" href="{{asset(env('APP_ASSETS').'/'.'assets/images/new.png')}}" type="image/png">
    <title>تعديل التاريخ</title>
</head>
<body>
    <div class="main text-center"> 
        <div class="w-50 d-flex justify-content-around">
            <a class="btn btn-darkgold d-flex align-items-center" href="{{route('consultations.index')}}"><i class="fa-solid fa-handshake me-2"></i>الاستشارات</a>
            <h3>اضافة وتعديل الوقت</h3>
            <a class="btn btn-lightgold d-flex align-items-center" href="{{route('admin.index')}}"><i class="fa-solid fa-gauge me-2"></i>لوحة التحكم</a>
        </div>
        @if(Session::get('success'))
            <div class="successalert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                {{$message = Session::get('success')}}
            </div>
        @endif
        <div class="edit-time-container">
            <div class="edit-time-content">
                
                <form action="{{route('consultation.date.times.updateorcreate',$date->id)}}" id="chooseTime" class="text-center" method="POST">
                    @csrf
                    @method('PUT')
                    <div>
                        <input type="date" class="form-control mb-3" name="date" value="{{$date->date}}">
                    </div>
                    <div>
                        <button type="button" class="btn btn-lightgold" id="addTimeButton">
                            اختيار التوقيتات
                        </button>                        
                    </div>
                    <br>
                    <div id="generate_time">
                        @foreach ($date->times as $time)
                            <div>
                                <input type="time" name="from_time[]" value="{{$time->from_time}}">
                                <input type="time" name="to_time[]" value="{{$time->to_time}}">
                            </div>
                        @endforeach
                    </div>
                    <br>
                    {{-- <p class="generate_time_btn">
                        اضافة وقت
                    </p> --}}
                    <div>
                        <button type="submit" class="btn btn-darkgold">
                            حفظ التعديلات
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/jquery.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/fontawesome/js/all.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/bootstrap.bundle.min.js')}}"></script>
    <script>
    $(document).ready(function() {
            $("#addTimeButton").click(function() {
                // إنشاء حقول جديدة في الفورم الثاني
                var newTimeInputs = `<div class="row">
                                    <div class="col-6">
                                        <label>من</label>
                                        <input class="form-control" type="time" name="from_time[]">
                                    </div>
                                    <div class="col-6">
                                        <label>الى</label>
                                        <input class="form-control" type="time" name="to_time[]">
                                    </div>
                                    </div>`;
                $("#chooseTime #generate_time").append(newTimeInputs);
            });
        });


    </script>
</body>
</html>
