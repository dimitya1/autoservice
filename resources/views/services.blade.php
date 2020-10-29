@extends('layout')

@section('title', 'Услуги')

@section('content')
    <div class="container">
        <br>
        <ul class="nav nav-tabs nav-fill">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">Главная</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">Услуги</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Контакты</a>
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
        @guest()
            <div class="alert alert-warning" role="alert">
                Пожалуйста, зарегистрируйтесь или войдите для создания заявки
            </div>
        @endguest
        @auth()
            <div class="alert alert-info" role="alert">
                Нажмите на кнопку, чтобы создать заявку
                <p><a href="{{ route('request.create') }}" style="margin-top: 20px" class="btn btn-info">Создать заявку</a></p>
            </div>
        @endauth

        <div class="row">
            <div class="col-2">
                <div class="btn-group-vertical">
                    @foreach($buttonsNormal as $buttonNormal)
                        <a href="{{ route('services.index', ['category' => str_replace(' ', '_', $buttonNormal)]) }}"
                           class="{{ $buttons[str_replace(' ', '_', $buttonNormal)] }}" role="button"
                           aria-pressed="true">{{ $buttonNormal }}</a>
                    @endforeach
                </div>
            </div>
            <div class="col-10">
                @if($worklists->isEmpty())
                    <h4><b>Мы выполням любые услуги по диагностике и ремонту автомобиля. Выберите любую интересующую Вас
                            категорию из списка слева и убедитесь сами!</b></h4>
                @endif
                <div class="row">
                    @foreach($worklists as $worklist)
                        <div class="col-4">
                            <div class="card border-info mb-3" style="max-width: 18rem;">
                                <div class="card-header">{{ $worklist->category }}</div>
                                <div class="card-body text-info">
                                    <h5 class="card-title">{{ $worklist->price . ' грн' }}</h5>
                                    <p class="card-text">{{ $worklist->name }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <br>
    </div>
    <br>
    <br>
@endsection
