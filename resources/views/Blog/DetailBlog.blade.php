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
        <div class="">

            <div class="">Chủ đề : {{ $data->title }}</div>
            <div class="">Người tạo : {{ $user->fullname }}</div>
            <div class="">Ngày tạo : {{ $data->createAt }}</div>
            <div class="">Địa chỉ email : {{ $user->email }}</div>
            <div class="mt-5"></div>
            <div class="font-semibold">Nội dung</div>
            <div class="">{{ $data->content }}</div>
        </div>
        <div class="text-[50px] font-semibold text-red-400">
          <a href="/blog/edit-detail-blog/{{$data->id}}">Chỉnh sửa lại bài viết</a>
        </div>
        <div class="">
            <div class="text-[50px] font-semibold">Bình luận</div>

            <form action="/blog/comment-detail-blog" method="POST">
                @error('content')
                    <div class="">{{ $message }}</div>
                @enderror
                <div class="">
                    <textarea name="content" class="p-3 w-full outline-none border-b-2" placeholder="Nội dung"></textarea>
                </div>
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="blog_id" value="{{ $data->id }}">
                <input type="hidden" name="fullname" value="{{ $user->fullname }}">
                <div class="text-right">
                    <input type="submit" class="py-2 px-10 hover:cursor-pointer rounded-lg bg-green-400">
                </div>
                @method('POST') @csrf
            </form>
        </div>

        <div class="mt-5"></div>
        <div class="flex flex-col gap-y-5">
            @foreach ($commentBlog as $comment)
                <div class="bg-gray-300 p-2 relative">
                    <div class="flex  justify-between">
                        <div class="">Người tạo: {{ $comment->fullname }}</div>
                        <div class="">Ngày tạo : {{ $comment->createAt }}</div>
                    </div>
                    <div class="">{{ $comment->content }}</div>
                    <div class="absolute right-0 bottom-0 flex gap-2">
                     <a href="/blog/edit-comment/{{ $comment->id }}/{{ $comment->blog_id }}"
                        class=" px-2 bg-yellow-300 font-semibold hover:text-white hover:bg-yellow-500 rounded-t-lg">
                        Sửa
                    </a>

                        <a href="/blog/delete-comment/{{ $comment->id }}/{{ $comment->blog_id }}"
                            class=" px-2 bg-red-300 font-semibold hover:text-white hover:bg-red-500 rounded-tl-lg">
                            Xóa
                        </a>


                    </div>

                </div>
            @endforeach
        </div>
        <div class="text-[50px] font-semibold">Các bài viết khác</div>

        <div class="grid grid-cols-4 gap-5 ">
            @foreach ($allBlog as $blog)
                <a href="/blog/detail-blog/{{ $blog->id }}">
                    <div class="bg-gray-300 p-2 rounded-lg">
                        <div class="font-semibold">Chủ đề: {{ $blog->title }}</div>
                        <div class="">Người tạo: {{ $blog->fullname }}</div>
                        <div class="">Ngày tạo: {{ $blog->createAt }}</div>
                    </div>

                </a>
            @endforeach
        </div>
    </div>

</body>

</html>
