@extends('layout')

@section('title', 'Добавление новой позиции')

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
    <br>


    <div class="container" style="margin-bottom: 90px">

        <form method="post" action="{{ route('admin.tools.store') }}">
            @csrf

            <div class="form-group">
                @error('name2')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="name2">Название</label>
                <input type="name2" name="name2" class="form-control">
            </div>

            <div class="form-group">
                @error('quantity')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="quantity">Количество</label>
                <input name="quantity" class="form-control" value="1">
                <small id="quantityHelp" class="form-text text-muted">Только цифры.</small>
            </div>

            <div class="form-group">
                @error('description')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="description">Описание</label>
                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                <small id="descriptionHelp" class="form-text text-muted">Необязательное поле.</small>
            </div>

            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
        <br>
    </div>
@endsection
