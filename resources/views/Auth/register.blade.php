<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('./css/newtailwindcss.css')}}">
    <title>Đăng ký</title>
</head>
<body>
<div class="m-0 p-0 border-box  border-0 outline-0">
    <x-header/>
    <p class="text-center text-[20px] font-bold "> Đăng ký tài khoản</p>
    <div class="h-full w-[500px] mx-auto">
        <form action="/register" method="post">
            <div class="">Ho va ten</div>
            <input type="text"
                class="w-full p-2 border-2 rounded-lg my-2"
            name="fullname" placeholder="Nhập họ tên" value="{{old('fullname')}}">
            @error('fullname')
                <div class="text-red-500">{{ $message }}</div>
            @enderror

            <div class="">Số điện thoại</div>
            <input type="text"
                class="w-full p-2 border-2 rounded-lg my-2"
            name="phone" placeholder="Nhập số điện thoại" value="{{ old('phone')}}">
            @error('phone')
                <div class="text-red-500">{{ $message }}</div>
            @enderror

            <div class="">Email</div>
            <input type="text" class="w-full p-2 border-2 rounded-lg my-2" name="email" placeholder="Nhap tai khoan" name="email" value="{{old('email')}}">
            @error('email')
                <div class="text-red-500">{{ $message }}</div>
            @enderror

            <div class="">Mật khẩu</div>
            <input type="text" class="w-full p-2 border-2 rounded-lg my-2" placeholder="Nhap mat khau ..." name="password">
            @error('password')
                <div class="text-red-500">{{ $message }}</div>
            @enderror

            <div class="">Nhập lại mật khẩu</div>
            <input type="text" class="w-full p-2 border-2 rounded-lg my-2" placeholder="Nhap lại mat khau..." name="confirm_password">
            @error('confirm_password')
                <div class="text-red-500">{{ $message }}</div>
            @enderror

   

            <div class="flex flex-row-reverse mb-2">
                <a href="login" class=" p-1 text-blue-500 rounded-lg ">Đăng nhập hệ thống</a>
            </div>

            <input class="bg-blue-200 p-2 rounded-lg w-full text-center hover:cursor-pointer" type="submit" value="Đăng ký"/>
            
            @csrf @method("post")
        </form>
    </div>
</div>
</body>
</html>