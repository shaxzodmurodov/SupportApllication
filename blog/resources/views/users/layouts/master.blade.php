<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRM System</title>
</head>
<link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}">

<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">
        <a href="{{route('index')}}">
            Техническая поддержка
        </a>
    </h5>
    <nav class="my-2 my-md-0 mr-md-3">
        @auth
            <a class="p-2 text-dark" href="{{route('user.messages.index')}}">Обращения</a>
            <a class="p-2 text-dark" href="{{route('user.messages.create')}}">Написать обращение</a>
        @endauth
    </nav>
    @guest
        <a class="btn btn-outline-primary" href="{{route('login')}}">Войти</a>
        @if(Route::has('register'))
            <a class="btn btn-outline-primary" href="{{route('register')}}">Зарегестрироваться</a>
        @endif
    @else
        <a class="btn btn-outline-primary">{{Auth::user()->name}}</a>
        <form action="{{route('logout')}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-primary">Выйти</button>
        </form>
    @endguest
</div>
<div class="container justify-content-center">
    @yield('content')
</div>


<script type="text/javascript" src="{{asset('front/js/bootstrap.min.js')}}" async></script>
<script type="text/javascript" src="{{asset('front/js/jquery_3.2.1_jquery.js')}}" async></script>
</body>
</html>
