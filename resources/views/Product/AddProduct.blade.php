<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('./css/app.css') }}">
    <title>Document</title>
</head>

<body>
    @if (!empty($_SESSION['loginToken']))
        <x-headerLogin />
    @else
        <x-header />
    @endif
    <div class=""></div>
    <div class="w-[1200px] mx-auto ">
        <form action="/product" method="POST">
            <div class="flex flex-col gap-y-5">
                <div class="">
                    <div class="">Tên sản phẩm</div>
                    <input type="text" class="border-b-[2px] w-full outline-none border-0" placeholder="Tên sản phẩm"
                        name="title">
                </div>
                <div class="">
                    <div class="">Giá</div>
                    <input type="text" class="border-b-[2px] w-full outline-none border-0" placeholder="Giá"
                        name="price">
                </div>

                <div class="">
                    <div class="">Danh mục</div>
                    <input type="text" class="border-b-[2px] w-full outline-none border-0" placeholder="Danh mục"
                        name="category">
                </div>
                <div class="">
                    <div class="">Link hình ảnh</div>
                    <input type="text" class="border-b-[2px] w-full outline-none border-0" placeholder="Link hình ảnh"
                        name="image">
                </div>
                <div class="">
                    <div class="">Miêu tả</div>
                    <textarea name="description" class="border-b-[2px] w-full outline-none border-0" placeholder="Miêu tả"></textarea>
                </div>
                <div class="">
                    <div class="">Rate</div>
                    <input type="text" class="border-b-[2px] w-full outline-none border-0" placeholder="Rate"
                        name="rate">
                </div>
                <div class="">
                    <div class="">Count</div>
                    <input type="text" class="border-b-[2px] w-full outline-none border-0" placeholder="Count"
                        name="count">
                </div>
                <div class="flex flex-col items-right">
                    <input type="submit"
                        class="px-10 py-2 bg-green-500  text-white font-semibold rounded-lg hover:cursor-pointer">
                </div>

            </div>
            @method('POST') @csrf
        </form>
    </div>
</body>

</html>
