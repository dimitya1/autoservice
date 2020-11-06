@extends('layout')

@section('title', 'Авто Сервис')

@section('content')
    <div class="container">
        <br>
        <p class="text-center"
           style="font-size: 52px; text-align: center; color: #800000; font-family: 'Segoe UI Black'; ">
            <i>Авто сервис "Политех"</i></p>
    </div>
    <div class="container">
        <br>
        <ul class="nav nav-tabs nav-fill">
            <li class="nav-item">
                <a class="nav-link active" href="#">Главная</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('services.index') }}">Услуги</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('contacts') }}">Контакты</a>
            </li>
            <li class="nav-item dropdown">
                @auth
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true" aria-expanded="false">{{ auth()->user()->name }}</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('profile') }}">Мой профиль</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('car.create') }}">Добавить автомобиль</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('request.create') }}">Записаться на диагностику/ремонт</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('repairs.index') }}">Работы по моим автомобилям</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}">Выйти</a>
                    </div>
                @endauth
                @guest
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true" aria-expanded="false">Личный кабинет</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('login') }}">Вход</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('register') }}">Регистрация</a>
                    </div>
                @endguest
            </li>
        </ul>
        <br>
    </div>

    <div class="container">
        @if(auth()->user() !== null && auth()->user()->is_admin === 1)
            <a href="{{ route('admin.panel') }}" style="margin-top: 20px; margin-bottom: 20px" class="btn btn-danger btn-lg btn-block">Административная панель</a>
        @endif

        @if(Session::has('successful login'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('successful login') }}
            </div>
        @endif
        @if(Session::has('successful register'))
            <div class="alert alert-success" role="alert">
                <b>{{ Session::get('successful register') }}</b>
                <p><a href="{{ route('car.create') }}" class="btn btn-success" style="margin-top: 20px">Добавить автомобиль</a></p>
            </div>
        @endif

        <h4>Авто сервис «Политех» - это ремонт вашего автомобиля в Одессе качественно и недорого</h4>
        <br>
        <div class="row">
            <div class="col-8">
                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/assets/img/avtoservis1.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block" id="bg">
                                <h2>Лучший персонал</h2>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="/assets/img/avtoservis2.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block" id="bg">
                                <h2>Оригинальные запчасти</h2>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="/assets/img/avtoservis3.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block" id="bg">
                                <h2>Профессиональное оборудование</h2>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Мы используем профессиональное оборудование и инструменты</li>
                    <li class="list-group-item">Мы работаем с оригинальными запчастями и материалами</li>
                    <li class="list-group-item">Мы гарантируем качество выполненных работ</li>
                    <li class="list-group-item">Мы знаем все тонкости сервисного обслуживания - починим всё</li>
                    <li class="list-group-item">Система скидок для наших клиентов</li>
                </ul>
            </div>
        </div>
        <br>
    </div>
    <div class="container">
        <div class="alert alert-info" role="alert" id="bg">
            <h3 style="text-align: center"><strong>Мы ремонтируем почти все марки автомобилей</strong></h3>
        </div>
        <img src="/assets/img/brands.jpg" class="img-fluid" alt="Responsive image">
    </div>
    <br>
    <br>
@endsection
