@extends('layout.layout')
@section('title','بيانات الحساب')
@section('extrastyle')
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/userinfo.css')}}">
@endsection
@section('content')
@if(Session::has('success'))
    <div class="successalert ">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{$message = Session::get('success')}}
    </div>
@endif



<section class="userinfo py-5">
    <div class="container">
        <div class="sec-header">
            <h2>بيانات الحساب الشخصي</h2>
        </div>
        <form action="{{route('userinfo.update')}}" class="w-75 mx-auto p-4" id="update" method="POST">
            @csrf
            @method('PATCH')
            @error('name')
                <div class="erroralert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    {{$message}}
                </div>
            @enderror
            <label for="name">الأسم</label>
            <input type="text" id="name" name="name" class="form-control mb-3" placeholder="الاسم" value="{{Auth::user()->name}}">
            @error('email')
                <div class="erroralert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    {{$message}}
                </div>
            @enderror
            <label for="email">البريد الإلكتروني</label>
            <input type="email" id="email" name="email" class="form-control mb-3" placeholder="البريد الالكتورني" value="{{Auth::user()->email}}">
            @error('phone')
                <div class="erroralert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    {{$message}}
                </div>
            @enderror
            <label for="phone">رقم الهاتف</label>
            <input type="text" id="phone" name="phone" class="form-control mb-3" placeholder="رقم الهاتف" value="{{Auth::user()->phone}}">
            <button type="submit" class="btn btn-darkgold"><i class="fa-regular fa-floppy-disk me-2"></i>حفظ التعديلات</button>
        </form>
    </div>
</section>
<script>
    // function validateForm() {
    //     const name = document.getElementById('name').value;
    //     const email = document.getElementById('email').value;
    //     const phone = document.getElementById('phone').value;

    //     const namePattern = /^[\u0600-\u06FF\s]+$/;
    //     const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    //     const phonePattern = /^\d{7,12}$/;

    //     if (!(name.length >= 2 && namePattern.test(name)) && !(name.length >= 3 && /^[a-zA-Z\s]+$/.test(name))) {
    //         document.getElementById('nameError').style.display = 'block';
    //         return false;
    //     } else {
    //         document.getElementById('nameError').style.display = 'none';
    //     }

    //     if (!emailPattern.test(email)) {
    //         document.getElementById('emailError').style.display = 'block';
    //         return false;
    //     } else {
    //         document.getElementById('emailError').style.display = 'none';
    //     }

    //     if (!phonePattern.test(phone)) {
    //         document.getElementById('phoneError').style.display = 'block';
    //         return false;
    //     } else {
    //         document.getElementById('phoneError').style.display = 'none';
    //     }

    //     return true;
    // }
</script>

@endsection