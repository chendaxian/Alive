<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <link rel="shortcut icon" href="{{URL::asset('img/logo.jpg')}}">
    <title>悦享后台登录</title>
    <link href="{{ URL::asset('css/staffLogin.css') }}" type="text/css" rel="stylesheet">
</head>
<body>

<div class="login">
    <div class="message">悦享小程序后台</div>
    <div id="darkbannerwrap"></div>

    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <input name="email" placeholder="用户名" required="" type="text">
        <hr class="hr15">
        <input name="password" placeholder="密码" required="" type="password">
        <hr class="hr15">
        <input value="登录" style="width:100%;" type="submit">
        <hr class="hr20">
    </form>


</div>

<div class="copyright">2018 © 悦享小程序商城官方后台</div>

</body>
</html>
