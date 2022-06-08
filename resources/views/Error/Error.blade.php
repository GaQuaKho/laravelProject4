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
    <div class="">
       <div class="text-[100px] font-semibold text-center">Lỗi hệ thống</div>
       <div class="h-[400px] w-[700px] mx-auto">
          <img src="https://media.istockphoto.com/photos/error-404-3drendering-page-concept-picture-id1302333331?b=1&k=20&m=1302333331&s=170667a&w=0&h=t-4iFoxu6BLO002CSbv_F_S2b02xAiI5O1sYPjE92T8=" class="w-full h-full" alt="">
       </div>
    </div>
</body>

</html>
