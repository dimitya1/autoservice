@extends('layout')

@section('title', 'Контакты')

@section('content')
    <div class="container">
        <br>
        <ul class="nav nav-tabs nav-fill">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">Главная</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('services.index') }}">Услуги</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">Контакты</a>
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
                        <a class="dropdown-item" href="{{ route('request.create') }}">Записаться на
                            диагностику/ремонт</a>
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
            <a href="{{ route('admin.panel') }}" style="margin-top: 20px" class="btn btn-danger btn-lg btn-block">Административная
                панель</a>
        @endif
        <h2 style="text-align: center; margin-bottom: 30px">Контакты</h2>

        <h4>Электронная почта:</h4>
        <a href="https://www.google.com/intl/ru/gmail/about/">
            <img src="https://img.icons8.com/ios-filled/50/000000/email-open.png"/></a>autoservice.politex@gmail.com

        <h4>Мобильный телефон:</h4>
        <p><img src="https://img.icons8.com/ios-filled/50/000000/apple-phone.png"/>+380995683944</p>

        <br>
        <h4>Подписывайтесь на нас в социальных сетях</h4>
        <a href="https://www.facebook.com">
            <img src="https://img.icons8.com/fluent-systems-filled/48/000000/facebook-new.png"/></a>
        <br>
        <a href="https://www.youtube.com">
            <img src="https://img.icons8.com/ios-filled/50/000000/youtube-play.png"/></a>
        <br>
        <a href="https://www.instagram.com">
            <img src="https://img.icons8.com/fluent-systems-filled/48/000000/instagram-new.png"/></a>
        <br>
        <a href="https://tlgrm.ru">
            <img src="https://img.icons8.com/ios-filled/50/000000/telegram-app.png"/></a>

        <h3 style="text-align: center; margin-bottom: 30px">Как к нам добраться</h3>
        <h5>Мы находимся в городе Одесса по адресу пр-т Шевченка, 1</h5>
        <!--Google map-->
        <div id="map-container-google-1" class="z-depth-1-half map-container" style="height: 100px; width: 900px">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2748.430433750869!2d30.7484201155547!3d46.45998147912533!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40c633d883fbc887%3A0x289ed34b9af0f872!2z0L_RgNC-0YHQvy4g0KjQtdCy0YfQtdC90LrQviwgMS80LCDQntC00LXRgdGB0LAsINCe0LTQtdGB0YHQutCw0Y8g0L7QsdC70LDRgdGC0YwsIDY1MDAw!5e0!3m2!1sru!2sua!4v1604492773315!5m2!1sru!2sua"
                width="400" height="350" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                tabindex="0"></iframe>
        </div>
        <!--Google Maps-->
    </div>
    <br>
    <br>
@endsection
