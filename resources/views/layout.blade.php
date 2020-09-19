<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>ddddddddddddddddd</title>
{{--    <title>@yield('title')</title>--}}
</head>
<body>

<div class="container">
{{--    <div class="row">--}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Автосервис Одесса</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Таирово Краснова, 5</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">О нас <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Услуги
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Список услуг</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Записаться</a>
                        </div>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Контакты <span class="sr-only">(current)</span></a>
                    </li>
                    @guest()
                        <form class="form-inline">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Личный кабинет <span class="sr-only">(current)</span></a>
                            </li>
                        </form>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Личный кабинет <span class="sr-only">(current)</span></a>
                    </li>
                    @endguest
                    @auth()
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Hello <span class="sr-only">(current)</span></a>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
{{--        <div class="col-8">--}}
{{--            <a href="{{ route('home') }}" class="btn btn-light">--}}
{{--            <a href="#" class="btn btn-light">--}}
{{--                <img src="/assets/img/001-home-run.svg" alt="" width="32" height="32" title="Home"> Take me home</a>--}}
{{--            <br>--}}
{{--            <br>--}}
{{--        </div>--}}

{{--        <div class="col-4">--}}
{{--            @guest--}}
{{--                <p>Lox</p>--}}
{{--            @endguest--}}

{{--            @auth--}}
{{--                <p>Hi, {{ auth()->user()->name }}</p>--}}
{{--                <p><a href="{{ route('ad.create') }}" class="btn btn-success">Create ad</a></p>--}}
{{--                <p><a href="{{ route('logout') }}" class="btn btn-primary">Logout</a></p>--}}
{{--            @endauth--}}
{{--        </div>--}}
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
