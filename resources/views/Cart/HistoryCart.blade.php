<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('./css/app.css') }}">
</head>

<body>
    @if (!empty($_SESSION['loginToken']))
        <x-headerLogin />
    @else
        <x-header />
    @endif
    <div class="mt-5"></div>
    <div class="w-[1200px] mx-auto">
        <div class="text-[50px] font-semibold">Lịch sử mua hàng</div>
        <div class="mt-5"></div>
        <div class="grid grid-cols-2 gap-10">

            @foreach ($data as $item)
                <div class="flex items-center gap-10">
                    <div class="w-[300px] h-[150px]">
                        <img src="{{$item->img}}"
                            class="w-full h-full fit-cover" alt="">
                    </div>
                    <div class="flex flex-col">
                        <div class="">Tên sản phẩm : {{$item->title}}</div>
                        <div class="">Giá : {{$item->price}}</div>
                        <div class="">Ngày mua : {{$item->createAt}}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="mt-5"></div>
    <x-footer />
</body>

</html>
