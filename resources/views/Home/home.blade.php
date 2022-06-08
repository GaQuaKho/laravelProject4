<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('./css/app.css') }}">
    <title>Home</title>
</head>

<body>
    @if (!empty($_SESSION['loginToken']))
        <x-headerLogin />
    @else
        <x-header />
    @endif
    <div class="mt-5"></div>

    <div class="grid grid-cols-4 gap-5 w-[1200px] mx-auto">
        @if (!empty($product))
            @foreach ($product as $value)
                <div class="flex flex-col ">
                    <div class=" h-[300px]">
                        <a href="/product/detail-product/{{$value->id}}">

                            <img src="{{ $value->image }}" class="w-full h-full fit-cover" alt="">
                        </a>
                    </div>
                    <div class="flex justify-between">
                        <div class="">Rate: {{ $value->rate }}</div>
                        <div class="">Count: {{ $value->count }}</div>
                    </div>
                    <div class="">Tên: {{ $value->title }}</div>
                    <div class="">Giá: {{ $value->price }}</div>
                    @if (!empty($_SESSION['loginToken']))
                        <div class="flex justify-between">
                            <a href="/product/edit/{{ $value->id }}">
                                <div class="p-2 bg-yellow-400 rounded-lg hover:cursor-pointer">Sửa</div>
                            </a>
                            <a href="/product/delete/{{ $value->id }}">
                                <div class="p-2 bg-red-400 rounded-lg hover:cursor-pointer">Xóa</div>
                            </a>
                            <div class="">
                                <form action="/cart/add-product" method="POST">
                                    <input type="hidden" name="title" value="{{ $value->title }}">
                                    <input type="hidden" name="price" value="{{ $value->price }}" />
                                    <input type="hidden" name="image" value="{{ $value->image }}" />
                                    <input type="hidden" name="user_id" value="{{ $user_id }}" />
                                    <input type="submit"
                                        class="p-2 bg-green-400 rounded-lg hover:cursor-pointer addProduct"
                                        value="Thêm vào giỏ hàng">
                                    @method('POST') @csrf
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach

        @endif
    </div>
    <div class="mt-5"></div>
    <x-footer />

    <script>
        const addProduct = document.querySelectorAll(".addProduct");
        for (let i of addProduct) {

            i.addEventListener("click", () => {
                alert("Đã thêm vào giỏ hàng");
            })
        }
    </script>
</body>

</html>
