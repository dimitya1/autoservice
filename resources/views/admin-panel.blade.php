@extends('layout')

@section('title', 'Админ. панель')

@section('content')
    <div class="container">
        <a href="{{ route('admin.panel') }}" style="margin-top: 20px" class="btn btn-danger btn-lg btn-block">Административная панель</a>
    </div>
    <br>

    <div class="container" style="margin-bottom: 90px">
        <a href="{{ route('admin.users.index') }}" class="btn btn-danger btn-lg">Клиенты</a>
        <br>
        <a href="{{ route('admin.mechanics.index') }}" class="btn btn-danger btn-lg">Механики</a>
        <br>
        <a href="{{ route('admin.tools.index') }}" class="btn btn-danger btn-lg">Инструменты и расходники</a>
        <br>
        <a href="{{ route('admin.cars.index') }}" class="btn btn-danger btn-lg">Автомобили</a>
        <br>
        <a href="{{ route('admin.services.index') }}" class="btn btn-danger btn-lg">Услуги компании</a>
        <br>
        <a href="{{ route('admin.requests.index') }}" class="btn btn-danger btn-lg">Заявки клиентов и работы по ним</a>
    </div>
@endsection
