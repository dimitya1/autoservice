@extends('layout')

@section('title', 'Редактирование профиля')

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
                <a class="nav-link" href="{{ route('contacts') }}">Контакты</a>
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
    <br>


    <div class="container" style="margin-bottom: 90px">
        @if(Session::has('password does not match'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('password does not match') }}
            </div>
        @endif


        <form method="post" action="{{ route('profile.edit') }}">
            @csrf

            <div class="form-group">
                @error('name')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="name">ФИО</label>
                <input type="name" name="name" class="form-control"
                       value="{{ old('name', $authUser->name) }}">
            </div>

            <fieldset disabled>
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="text" id="disabledTextInput" class="form-control"
                           placeholder="{{ old('email', $authUser->email) }}">
                </div>
            </fieldset>

            <div class="form-group">
                @error('mobile')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="mobile">Телефон</label>
                <input type="mobile" name="mobile" class="form-control"
                       value="{{ old('mobile', $authUser->mobile_phone) }}">
            </div>

            <div class="form-group">
                @error('password')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="password">Пожалуйста, введите Ваш текущий пароль</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>

            <button type="submit" class="btn btn-primary">Подтвердить</button>
        </form>
    </div>
@endsection
