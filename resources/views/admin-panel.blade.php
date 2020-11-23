@extends('layout')

@section('title', 'Админ. панель')

@section('content')
    <div class="container">
        <a href="{{ route('admin.panel') }}" style="margin-top: 20px" class="btn btn-danger btn-lg btn-block">Административная панель</a>
    </div>
    <div class="container">
        <a href="{{ route('home') }}" style="margin-top: 15px" class="btn btn-info btn-lg btn-block">Пользовательская версия сайта</a>
    </div>
    <br>

    <div class="container" style="margin-bottom: 90px">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><a href="{{ route('admin.requests.index') }}" class="btn btn-dark btn-lg">Заявки клиентов и работы по ним</a></li>
            <li class="list-group-item"><a href="{{ route('admin.services.index') }}" class="btn btn-dark btn-lg">Услуги компании</a></li>
            <li class="list-group-item"><a href="{{ route('admin.users.index') }}" class="btn btn-dark btn-lg">Клиенты</a></li>
            <li class="list-group-item"><a href="{{ route('admin.cars.index') }}" class="btn btn-dark btn-lg">Автомобили</a></li>
            <li class="list-group-item"><a href="{{ route('admin.mechanics.index') }}" class="btn btn-dark btn-lg">Механики</a></li>
            <li class="list-group-item"><a href="{{ route('admin.tools.index') }}" class="btn btn-dark btn-lg">Инструменты и материалы</a></li>
        </ul>
    </div>
@endsection
