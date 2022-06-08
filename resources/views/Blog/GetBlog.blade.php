<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('./css/app.css') }}">
    <title>Đăng ký</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div class="">
        <x-headerLogin />
        <div class="mt-2 w-[1200px] mx-auto flex flex-row gap-x-4">
            <div class="w-[calc(1200px*0.7)] h-[30px]">
                @if (!empty($dataBlog))
                    @foreach ($dataBlog as $data)
                     <a href="/blog/detail-blog/{{$data->id}}">
                        <div class="relative">
                            <div class="bg-gray-400 rounded-t-lg p-2">
                                <div class="">Tác giả: {{ $data->fullname }}</div>
                                <div class="">Ngày đăng: {{ $data->createAt }}</div>
                            </div>
                            <div class=" bg-gray-300 rounded-b-lg p-2">
                                <div class="">
                                    Chủ đề: {{ $data->title }}
                                </div>
                            </div>
                            <div class="absolute top-[10px] right-[10px] text-[30px] bg-white rounded-lg"><a
                                    href="/blog/delete/{{ $data->id }}">&times;</a></div>
                        </div>

                     </a>
                        <div class="mt-[10px]"></div>
                    @endforeach
                @endif
            </div>
            <div class="w-[calc(1200px*0.3)] rounded-lg border-[1px] p-2 border-black ">
                <form action="/blog" method="POST">
                    <div class="my-1">Tên: {{ $ten }}</div>
                    <div class="my-1">Tiêu đề</div>
                    <input type="text" class="border-2 w-full max-w-[w-full] p-2 rounded-lg border-black" name="title">
                    <div class="">Nội dung</div>
                    <textarea name="content" class="border-black w-full p-1  rounded-lg border-2" rows="15"></textarea>

                    <input type="submit" class="w-full text-center my-1 hover:cursor-pointer p-2 rounded-lg bg-blue-300"
                        value="Đăng bài">
                    @csrf @method('POST')
                </form>
            </div>
        </div>
    </div>
</body>

</html>
