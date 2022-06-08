<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if(!empty($_SESSION["fullname"]))
        <div class="">Chúc mừng bạn {{ $_SESSION["fullname"]}} đã đăng kí thành công
        </div>
        <div class="">Ấn vào link sau để kích hoạt tài khoản</div>
        <a href="http://localhost:8000/active/{{ $_SESSION['activeToken'] }}">Link</a>
    @endif
    @php
        unset($_SESSION['activeToken']);
        unset($_SESSION["fullname"]);
    @endphp
    
</body>
</html>