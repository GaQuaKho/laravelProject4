<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('./css/newtailwindcss.css')}}">
    <title>Đăng nhập</title>
</head>
<body>
<x-header/>
<div class="m-0 p-0 border-box  border-0 outline-0">
    <p class="text-center text-[20px] font-bold mt-[100px]"> Đăng nhập hệ thống</p>
    <div class="h-full w-[500px] mx-auto">
        @if(!empty(session('activeKey')))
            <div class="p-2 bg-green-300 rounded-lg">{{ session('activeKey') }}</div>
        @endif
        <form action="/login" method="post">
            <div class="">Email</div>
            <input type="text" class="w-full p-2 border-2 rounded-lg my-2" placeholder="Nhap tai khoan" name="email" value="{{old('email')}}">
            @error('email')
                <div class="text-red-500">{{$message}}</div>
            @enderror

            <div class="">Mat khau</div>
            <input type="text" class="w-full p-2 border-2 rounded-lg my-2" placeholder="Nhap mat khau" name="password">
            @error('password')
                <div class="text-red-500">{{$message}}</div>
            @enderror

            <div class="flex flex-row-reverse mb-2">
                <a href="/forgot" class=" p-1 text-blue-500 rounded-lg ">Quên mật khẩu</a>
            </div>
            <div class="flex flex-row-reverse mb-2">
                <a href="register" class=" p-1 text-blue-500 rounded-lg ">Bạn chưa có tài khoản ?</a>
            </div>
            <input class="bg-blue-200 p-2 rounded-lg w-full text-center hover:cursor-pointer" type="submit" value="Đăng nhập"/>
        
            @csrf @method("post")
        </form>
    </div>
</div>
</body>
</html>