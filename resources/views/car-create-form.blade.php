@extends('layout')

@section('title', 'Добавление автомобиля')

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
                        <a class="dropdown-item" href="{{ route('profile') }}">Мой профиль</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item active" href="#">Добавить автомобиль</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Заказать услуги online</a>
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


    <div class="container" style="margin-bottom: 90px">
        <br>
        @if(Session::has('old car'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('old car') }}
            </div>
            <br>
        @endif
        @if(Session::has('duplicate vin'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('duplicate vin') }}
            </div>
            <br>
        @endif

        <form method="post" action="{{ route('car.store') }}">
            @csrf

            <div class="form-group">
                @error('make')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="make">Марка</label>
                <input type="make" name="make" class="form-control">
            </div>

            <div class="form-group">
                @error('model')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="model">Модель</label>
                <input type="model" name="model" class="form-control">
            </div>

            <div class="form-group">
                @error('year')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="year">Год выпуска</label>
                <input type="year" name="year" class="form-control">
            </div>

            <div class="form-group">
                @error('colour')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="colour">Цвет</label>
                <input type="colour" name="colour" class="form-control">
            </div>

            <div class="form-group">
                @error('vin')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="vin">vin-код</label>
                <input type="vin" name="vin" class="form-control">
                <small id="vinHelp" class="form-text text-muted">Пожалуйста, веедите правильный vin-номер.</small>
            </div>

            <button type="submit" class="btn btn-success">Добавить</button>
        </form>
        <br>
    </div>
@endsection
