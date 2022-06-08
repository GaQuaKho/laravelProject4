<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('./css/newtailwindcss.css')}}">
    <title>Đặt lại mật khẩu</title>
</head>
<body>
<div class="m-0 p-0 border-box  border-0 outline-0">
    <p class="text-center text-[20px] font-bold mt-[100px]"> Đặt lại mật khẩu</p>
    <div class="h-full w-[500px] mx-auto">
        <form action="/forgot" method="post">

            <div class="">Email</div>
            @error('email')
                <div class="text-red-500">{{$message}}</div>
            @enderror
            <input type="email" class="w-full p-2 border-2 rounded-lg my-2" placeholder="Nhap email" name="email" value="{{old('email')}}">
            
            <input class="bg-blue-200 p-2 rounded-lg w-full text-center hover:cursor-pointer" type="submit" value="Xác nhận"/>
       
          
            <div class="flex flex-row-reverse mb-2">
                <a href="register" class=" p-1 text-blue-500 rounded-lg ">Bạn chưa có tài khoản ?</a>
            </div>

            <div class="flex flex-row-reverse mb-2">
                <a href="login" class=" p-1 text-blue-500 rounded-lg ">Đăng nhập</a>
            </div>
            @csrf @method("post")
        </form>
    </div>
</div>
</body>
</html>