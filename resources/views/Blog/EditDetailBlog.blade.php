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
    <div class="w-[1200px] mx-auto">
        <div class="text-[50px] font-semibold">Sửa bài viết</div>
        <div class="">
            <form action="/blog/edit-detail-blog/{{ $data->id }}" method="POST">
                <div class="">
                    <div class="">Chủ đề</div>
                    @error('title')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                    <div class=""></div>
                    <input type="text" name="title" class="w-full border-b-2 outline-none p-2"
                        value="{{ $data->title }}">
                </div>
                <div class="">Nội dung</div>
                @error('content') 
                  <div class="text-red-500">{{$message}}</div>
                @enderror
                <textarea name="content" class="w-full border-b-2 outline-none p-2">{{ $data->content }}</textarea>
                <div class="text-right">
                    <input type="submit" class="py-2 px-10 hover:cursor-pointer bg-green-400 rounded-lg font-semibold">
                </div>
                @method('POST') @csrf
            </form>
        </div>
    </div>
</body>

</html>
