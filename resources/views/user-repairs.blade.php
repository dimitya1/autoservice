@extends('layout')

@section('title', 'Ремонты по моим автомобилям')

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
                        <a class="dropdown-item" href="{{ route('request.create') }}">Записаться на
                            диагностику/ремонт</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item active" href="#">Работы по моим автомобилям</a>
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
        @if(auth()->user() !== null && auth()->user()->is_admin === 1)
            <a href="{{ route('admin.panel') }}" style="margin-top: 40px; margin-bottom: 20px" class="btn btn-danger btn-lg btn-block">Административная панель</a>
        @endif
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Автомобиль</th>
                <th scope="col">Услуга</th>
                <th scope="col">Кто выполняет</th>
                <th scope="col">Телефон механика</th>
                <th scope="col">Статус</th>
                <th scope="col">Время создания</th>
            </tr>
            </thead>
            <tbody>
            @foreach($repairs as $repair)
                <tr>
                    <td>{{ $repair->request->car->make . ' ' . $repair->request->car->model . ' ' . $repair->request->car->year}}</td>
                    <td style="max-width: 200px">{{ $repair->service->name ?? null}}</td>
                    <td>{{ $repair->mechanic->name }}</td>
                    <td>{{ $repair->mechanic->mobile_phone }}</td>
                    @if(\Illuminate\Support\Carbon::parse($repair->request->date)->gt(\Illuminate\Support\Carbon::now()) && $repair->status === 0)
                        <td>{{ 'Приезжайте к нам с ' .
                            \Illuminate\Support\Carbon::parse($repair->request->date)->format("d.m с h:i") }}</td>
                    @else
                        <td>{{ $repair->status ? 'Завершена' : 'В работе'}}</td>
                    @endif
                    <td>{{ $repair->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <br>
@endsection
