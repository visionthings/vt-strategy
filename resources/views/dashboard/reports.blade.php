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
    
    <link rel="icon" href="{{asset(env('APP_ASSETS').'/'.'assets/images/new.png')}}" type="image/png">
    <title>تقرير</title>
    <style>
        body{
            background-color: #1e1e1e !important;
        }
        h3{
            color: var(--darkgold);
        }
        .printed{
            background-color: white;
        }
        .bold{
            font-weight: bold;
        }
        .printed table{
            border-collapse: separate;
            border-spacing: 0 10px; 
            width: 90%;
            margin: auto;
        }
        .printed table tr td{
            text-align: center;
            vertical-align: middle;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .printed table thead tr{
            background-color: var(--black);
            color: var(--darkgold);
            font-weight: bold;
        }
        .printed table thead tr td:first-child{
            border-radius: 0 25px 25px 0 !important;
            -webkit-border-radius: 0 25px 25px 0 !important;
            -moz-border-radius: 0 25px 25px 0 !important;
            -ms-border-radius: 0 25px 25px 0 !important;
            -o-border-radius: 0 25px 25px 0 !important;
        }
        .printed table thead tr td:last-child{
            border-radius: 25px 0 0 25px !important;
            -webkit-border-radius: 25px 0 0 25px !important;
            -moz-border-radius: 25px 0 0 25px !important;
            -ms-border-radius: 25px 0 0 25px !important;
            -o-border-radius: 25px 0 0 25px !important;
        }
        .printed table tbody tr{
            background-color: #c2c2c2ee;
            color: var(--black);
        }
        .printed table tbody tr td{
            padding-top: 6px;
            padding-bottom: 6px;
        }
        .printed table tbody tr td:first-child{
            border-radius: 0 25px 25px 0 !important;
            -webkit-border-radius: 0 25px 25px 0 !important;
            -moz-border-radius: 0 25px 25px 0 !important;
            -ms-border-radius: 0 25px 25px 0 !important;
            -o-border-radius: 0 25px 25px 0 !important;
        }
        .printed table tbody tr td:last-child{
            border-radius: 25px 0 0 25px !important;
            -webkit-border-radius: 25px 0 0 25px !important;
            -moz-border-radius: 25px 0 0 25px !important;
            -ms-border-radius: 25px 0 0 25px !important;
            -o-border-radius: 25px 0 0 25px !important;
        }
        @media (max-width:767px) {
            .printed table td{
                font-size: 13px;
            }
        }

    </style>
</head>
<body>
    
    <div class="container my-4">
        <div class="btns d-flex justify-content-between align-items-center">
            <button class="btn btn-darkgold" type="button" onclick="printData()"><i class="fa-solid fa-print"></i>  طباعة</button>
            <a class="btn btn-lightgold" href="{{route('admin.index')}}"><i class="fa-solid fa-gauge"></i>  لوحة التحكم </a>
        </div>
        <div class="printed w-75 mx-auto rounded-2 mt-3 p-3" id="printTable">
        <h3 class="text-center">تقرير الاستشارات</h3>
            <table border>
                <thead>
                    <tr>
                        <td>البند</td>
                        <td>الاسم</td>
                        <td>القيمة</td>
                    </tr>
                </thead>
                <tbody>
                
                    <tr>
                        <td class="bold">اهم استشارة الاكثر حجزاً</td>
                        <td>{{$highConsultionsOrder->name}} : </td>
                        <td>{{$highConsultionsOrder->max_order}}</td>
                    </tr>
                    <tr>
                        <td class="bold">  عدد الاستشارات العملاء الناجحه</td>
                        <td>العدد : </td>
                        <td>{{$getSuccessCountBooked}}</td>
                    </tr>
                    <tr>
                        <td class="bold"> عدد الحجوزات هذا الشهر</td>
                        <td>حجوزات : </td>
                        <td>{{$getCountBookedThisMonth}}</td>
                    </tr>
                   
                </tbody>
            </table>

        </div>
    </div>


    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/jquery.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/fontawesome/js/all.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/bootstrap.bundle.min.js')}}"></script>
    <script>
        
        function printData()
        {
        var divToPrint=document.getElementById("printTable");
        newWin= window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
        }

       
    </script>
</body>
</html>
