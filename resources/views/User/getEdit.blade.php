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
    @if(!empty($_SESSION["loginToken"]))
    <div class="m-0 p-0 border-box  border-0 outline-0">
        <x-headerLogin/>
        <p class="text-center text-[20px] font-bold "> Chỉnh sửa người dùng </p>
        <div class="h-full w-[500px] mx-auto">
            <form action="/user-edit/{{$id}}" method="post">
                <div class="">Ho va ten</div>
                <input type="text"
                    class="w-full p-2 border-2 rounded-lg my-2"
                name="fullname" placeholder="Nhập họ tên" value="{{ $fullname }}">
                @error('fullname')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
    
                <div class="">Số điện thoại</div>
                <input type="text"
                    class="w-full p-2 border-2 rounded-lg my-2"
                name="phone" placeholder="Nhập số điện thoại" value="{{  $phone}}">
                @error('phone')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
    
                <div class="">Email</div>
                <input type="text" class="w-full p-2 border-2 rounded-lg my-2" name="email" placeholder="Nhap tai khoan" name="email" value="{{  $email}}">
                @error('email')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
    
              
    
    
       
    
        
    
                <input class="bg-blue-200 p-2 rounded-lg w-full text-center hover:cursor-pointer" type="submit" value="Đăng ký"/>
                
                @csrf @method("post")
            </form>
        </div>
    </div>
    @endif
</body>
</html>