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
        <p class="text-center text-[20px] font-bold mt-[100px]">Đặt lại mật khẩu</p>
        <div class="h-full w-[500px] mx-auto">
         
            <form action="/reset/{{$token}}" method="post">
                <div class="">Mật khẩu mới</div>
                <input type="text" class="w-full p-2 border-2 rounded-lg my-2" placeholder="Nhập mật khẩu mới . . ." name="password">
                @error('password')
                    <div class="text-red-500">{{$message}}</div>
                @enderror
                <div class="">Nhập lại mật khẩu mới</div>
                <input type="text" class="w-full p-2 border-2 rounded-lg my-2" placeholder="Nhập lại mật khẩu mới . . ." name="confirm_password">

                <div class="flex flex-row-reverse mb-2">
                    <a href="http://localhost:8000/login" class=" p-1 text-blue-500 rounded-lg ">Đăng nhập</a>
                </div>
                <div class="flex flex-row-reverse mb-2">
                    <a href="http://localhost:8000/register" class=" p-1 text-blue-500 rounded-lg ">Đăng kí</a>
                </div>

                <input class="bg-blue-200 p-2 rounded-lg w-full text-center hover:cursor-pointer" type="submit" value="Xác nhận"/>
            
                @csrf @method("post")
            </form>
        </div>
    </div>
</body>
</html>