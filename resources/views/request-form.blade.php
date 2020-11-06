@extends('layout')

@section('title', 'Создание заявки')

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
                        <a class="dropdown-item" href="{{ route('profile') }}">Мой профиль</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('car.create') }}">Добавить автомобиль</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item active" href="{{ route('request.create') }}">Записаться на диагностику/ремонт</a>
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
        @if(auth()->user() !== null && auth()->user()->is_admin === 1)
            <a href="{{ route('admin.panel') }}" style="margin-top: 20px" class="btn btn-danger btn-lg btn-block">Административная панель</a>
        @endif

        <form method="post" action="{{ route('request.store') }}">
            @csrf

            <div class="form-group">
                @error('no car selected')
                <br>
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref"><h1 style="color: #191aff">Автомобиль</h1></label>
                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="car">
                    <option selected style="font-style: italic">Выберите автомобиль</option>
                    @foreach($cars as $car)
                        <option>{{ $car->make . ' ' . $car->model . ' ' . $car->year }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                @error('no worklist selected')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <div class="form-check">
                    @foreach($categories as $category)
                        <h1>{{ $category }}</h1>
                        @foreach( \App\Models\Worklist::where('category', '=', $category)->get() as $worklist)
                            <input class="form-check-input" type="checkbox" value="{{ $worklist->name }}" id="invalidCheck2" name="{{ $worklist->name }}">
                            <p><label class="form-check-label" for="invalidCheck2">{{ $worklist->name . ' ' . $worklist->price . 'грн'}}</label></p>
                        @endforeach
                    @endforeach
                </div>
            </div>
            <br>
            <br>
            <div class="form-group">
                <h4><label for="exampleFormControlTextarea1">Опишите, пожалуйста, работы по автомобилю, если в этом есть необходимость</label></h4>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

            <button type="submit" class="btn-lg btn-primary">Создать заявку</button>
        </form>
        <br>
    </div>
@endsection
