<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('./css/newtailwindcss.css')}}">
    <title>Home</title>
</head>
<body>
        <x-headerLogin/>
    <div class="flex flex-row-reverse w-[1200px] mx-auto">
        <a href="/user-add"
            class="p-2 bg-green-200 rounded-lg"
        >Thêm người dùng</a>
    </div>
    <div class="grid w-[1200px] mx-auto text-center my-2 grid-cols-7 gap-2">
        <div class="">ID</div>
        <div class="">Email</div>
        <div class="">Full name</div>
        <div class="">Phone</div>
        <div class="">status</div>
        <div class="">create_at</div>
        <div class="">update_at</div>
    </div>
    @if(!empty($data))
    @foreach($data as $item)
    
    <div class="grid w-[1200px] border-t-2 border-black p-2 mx-auto text-center my-2 grid-cols-7 gap-2">
        
        <div class="">{{$item->id}}</div>
        <div class="">{{$item->email}}</div>
        <div class="">{{$item->fullname}}</div>
        <div class="">{{$item->phone}}</div>
        <div class="">{{$item->status}}</div>
        <div class=""><a class=" py-1 px-10 bg-green-200 rounded-lg w-full" href="/user-edit/{{$item->id}}">Sửa</a></div>
        <div class=""><a class=" py-1 px-10 bg-red-200 rounded-lg w-full" href="user-delete/{{$item->id}}">Xóa</a></div>
    </div>
    @endforeach
    @endif
    <div class="flex w-[1200px] gap-4 justify-center mx-auto">
        @if(!empty($length)) 
        @for($i=0; $i<$length; $i++)
        <a href="http://localhost:8000/user/{{$i}}">
            <div class="py-1 {{ (is_null($start) && $i==0) || $start==$i ? 'bg-red-500' : 'bg-blue-500'}}  px-3 ">{{$i}}</div>
        </a>
        @endfor
        @endif
    </div>

 

</body>
</html>