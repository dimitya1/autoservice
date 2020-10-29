@extends('layout')

@section('title', 'Профиль')

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
                <a class="nav-link" href="#">Контакты</a>
            </li>
            <li class="nav-item dropdown">
                @auth
                    <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true" aria-expanded="false">{{ auth()->user()->name }}</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item active" href="#">Мой профиль</a>
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
    <br>

    <div class="container">
        <br>
        @if(Session::has('successful car add'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('successful car add') }}
            </div>
            <br>
        @endif
        @if(Session::has('created request'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('created request') }}
            </div>
            <br>
        @endif
        <div class="card bg-light mb-3" style="max-width: 100rem;">
            <div class="card-header">{{ $authUser->email }}</div>
            <div class="card-body">
                <h5 class="card-title">{{ $authUser->name }}</h5>
                <h5 class="card-title">{{ $authUser->mobile_phone }}</h5>
                @if($authUser->cars->count() === 1)
                    <p class="card-text">Ваш автомобиль:</p>
                @elseif($authUser->cars->count() > 1)
                    <p class="card-text">Ваши автомобили:</p>
                @elseif($authUser->cars->count() === 0)
                    <p class="card-text">Вы пока не добавили свой автомобиль.</p>
                @endif

                @foreach($authUser->cars as $car)
                    <p class="card-text">	&#9899{{ $car->make . ' ' . $car->model . ' ' . $car->year }}</p>
                @endforeach
                <a href="{{ route('car.create') }}" class="btn btn-success" style="margin-bottom: 15px">Добавить автомобиль</a>

                @if($doneRepairsCount === 0 && $repairsCount !== 0)
                    <h5 class="card-text" style="margin-bottom: 20px"><b>Для Вас выполнено {{ $doneRepairsCount }} работ из {{ $repairsCount }}</b></h5>
                @endif
                @if($doneRepairsCount === 1)
                    <h5 class="card-text" style="margin-bottom: 20px"><b>Для Вас выполнена {{ $doneRepairsCount }} работа из {{ $repairsCount }}</b></h5>
                @elseif($doneRepairsCount >= 2 && $doneRepairsCount <= 4)
                    <h5 class="card-text" style="margin-bottom: 20px"><b>Для Вас выполнено {{ $doneRepairsCount }} работы из {{ $repairsCount }}</b></h5>
                @elseif($doneRepairsCount > 4)
                    <h5 class="card-text" style="margin-bottom: 20px"><b>Для Вас выполнено {{ $doneRepairsCount }} работ из {{ $repairsCount }}</b></h5>
                @endif

                @if($repairsCount > 0)
                    <a href="{{ route('repairs.index') }}" class="btn btn-info" style="margin-bottom: 25px">Подробнее о работах по автомобилю</a>
                @endif
                @if($authUser->cars->count() > 0)
                    <p><a href="{{ route('request.create') }}" class="btn-lg btn-secondary">Создать заявку</a></p>
                @endif
            </div>
            <div class="card-footer">
                <small class="text-muted">Профиль создан {{ $authUser->created_at->diffForHumans() }}</small>
            </div>
        </div>
    </div>
    <br>
    <br>
@endsection
