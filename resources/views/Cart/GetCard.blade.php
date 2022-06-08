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
    <div class="mt-10"></div>

    <div class="w-[1200px] mx-auto flex justify-between">
        <div class="">Danh sách giỏ hàng</div>
        <div class="">
          <a href="/cart/history-product" class="px-10 bg-green-400 text-white font-semibold py-2 rounded-lg">Lịch sử mua hàng</a>
        </div>
    </div>
    <div class="mt-10"></div>
    <div class="flex flex-col gap-10 w-[1200px] mx-auto">
        @if (count($cart) > 0)
            @foreach ($cart as $item)
                <div class="flex justify-between">
                    <div class="flex gap-x-10">
                        <div class="w-[200px] h-[100px]">
                            <img src="{{ $item->img }}" class="w-full h-full fit-cover" alt="">
                        </div>
                        <div class="flex flex-col justify-center">
                            <div class="">Tên : {{ $item->title }}</div>
                            <div class="">Giá : {{ $item->price }}</div>
                        </div>
                    </div>
                    <div class="flex flex-col justify-center ml-[100px]">
                        <form action="/cart/delete-product" method="POST">
                            <div class="">
                                <input type="hidden" value="{{ $item->id }}" name="id">
                            </div>
                            <div class="flex">
                                <input type="submit"
                                    class="px-10 pt-1 rounded-lg bg-red-500 text-white font-semibold hover:cursor-pointer"
                                    value="Xóa">
                            </div>
                            @method('POST') @csrf
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <div class="">Chưa có sản phẩm nào</div>
        @endif
    </div>
    <div class="mt-10"></div>

    <div class="text-center ">
        <form action="/cart/pay-product" method="POST">
            <div class="">
                <div class="w-[1200px] mx-auto">
                    <div class="">
                        @error('address')
                            <div class="text-red-500 text-left">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-5"></div>
                    @foreach ($cart as $item)
                        <input type="hidden" name="id_{{ $item->id }}" value="{{ $item->id }}">
                    @endforeach
                    <input type="text" placeholder="Nhập địa chỉ để thanh toán" class="w-full outline-none border-b-2 p-2"
                        name="address" class="w-full">
                </div>


            </div>
            <div class="mt-5"></div>
            <input type="submit" value="Thanh toán sản phẩm"
                class="px-10 py-2 bg-blue-400 text-white font-semibold rounded-lg hover:cursor-pointer" />
            @method('POST') @csrf
        </form>
    </div>
    <div class="mt-10"></div>
    <x-footer />
</body>

</html>
