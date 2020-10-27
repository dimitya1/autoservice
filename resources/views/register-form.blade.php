@extends('layout')

@section('title', 'Регистрация')

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
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true" aria-expanded="false">{{ auth()->user()->name }}</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('profile') }}">Мой профиль</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('car.create') }}">Добавить автомобиль</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Заказать услуги online</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}">Выйти</a>
                    </div>
                @endauth
                @guest
                    <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true" aria-expanded="false">Личный кабинет</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('login') }}">Вход</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item active" href="#">Регистрация</a>
                    </div>
                @endguest
            </li>
        </ul>
        <br>
    </div>
    <br>


    <div class="container" style="margin-bottom: 90px">

        <br>
        @if(Session::has('duplicate email'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('duplicate email') }}
            </div>
        @endif
        <br>

        <form method="post" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                @error('name')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="name">ФИО</label>
                <input type="name" name="name" class="form-control">
                <small id="nameHelp" class="form-text text-muted">Мы не передаём личную информацию третим
                    лицам.</small>
            </div>

            <div class="form-group">
                @error('email')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="email">E-Mail</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp">
            </div>

            <div class="form-group">
                @error('mobile')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="mobile">Мобильный номер</label>
                <input type="mobile" name="mobile" class="form-control" placeholder="+380">
                <small id="mobileHelp" class="form-text text-muted">Мобильный номер в международном формате.</small>
            </div>

            <div class="form-group">
                @error('password')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                <small id="passwordHelp" class="form-text text-muted">Пароль должен быть на английском языке, состоять минимум из 6 символов,
                    содержать строчные и заглавные буквы и хотя бы 1 цифру.</small>
            </div>

            <div class="form-group">
                @error('password_confirmation')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="password_confirmation">Подтвердите пароль</label>
                <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1">
            </div>

            <button type="submit" class="btn btn-primary">Регистрация</button>
        </form>
        <br>
    </div>
@endsection
