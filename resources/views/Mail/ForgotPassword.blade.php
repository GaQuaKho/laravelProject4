<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('./css/newtailwindcss.css')}}">
    <title>Quên mật khẩu</title>
</head>
<body>
<div class="text-center">
    Nhấn vào link sau để khôi phục mật khẩu
    <a href="http://localhost:8000/reset/{{$_SESSION["tokenForgotPassword"]}}">day</a>
</div>
@php
    unset($_SESSION["tokenForgotPassword"]);
@endphp
</body>
</html>