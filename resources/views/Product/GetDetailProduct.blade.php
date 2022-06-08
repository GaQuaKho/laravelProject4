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
    <div class="mt-5"></div>
    <div class="w-[1200px] mx-auto">

        <div class="">Danh mục : {{ $data->category }}</div>
        <div class="mt-5"></div>
        <div class="grid grid-cols-2 gap-5">

            <div class="h-[500px] w-[500px]">
                <img src="{{ $data->image }}" class="w-full h-full fit-cover" alt="">
            </div>
            <div class="">
                <div class="">Tên sản phẩm : {{ $data->title }}</div>
                <div class="">Giá : {{ $data->price }}</div>
                <div class="">Đánh giá : {{ $data->rate }}</div>
                <div class="">Số lượng : {{ $data->count }}</div>
                <div class="">
                  <form action="/cart/add-product" method="POST">
                      <input type="hidden" name="title" value="{{ $data->title }}">
                      <input type="hidden" name="price" value="{{ $data->price }}" />
                      <input type="hidden" name="image" value="{{ $data->image }}" />
                      <input type="hidden" name="user_id" value="{{ $user_id }}" />
                      <input type="submit"
                          class="p-2 bg-green-400 rounded-lg hover:cursor-pointer addProduct"
                          value="Thêm vào giỏ hàng">
                      @method('POST') @csrf
                  </form>
              </div>
            </div>

        </div>
        <div class="mt-5"></div>

        <div class="">Miêu tả</div>
        <div class="">{{ $data->description }}</div>

    </div>
    <div class="mt-5"></div>

    <x-footer />
    <script>
      const addProduct = document.querySelector(".addProduct");
      addProduct.addEventListener("click",()=>{
        alert("Đã thêm sản phẩm vào giỏ hàng");
      })
    </script>
</body>

</html>
