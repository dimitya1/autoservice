@extends('layout')

@section('title', 'Добавление нового автомобиля')

@section('content')
    <div class="container">
        <a href="{{ route('admin.panel') }}" style="margin-top: 20px" class="btn btn-danger btn-lg btn-block">Административная
            панель</a>
    </div>
    <div class="container">
        <a href="{{ route('home') }}" style="margin-top: 15px" class="btn btn-info btn-lg btn-block">Пользовательская версия сайта</a>
    </div>
    <br>

    <div class="container" style="margin-bottom: 90px">
        @if(Session::has('duplicate vin'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('duplicate vin') }}
            </div>
            <br>
        @endif
        @if(Session::has('user not found'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('user not found') }}
            </div>
            <br>
        @endif
        @if(Session::has('old car'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('old car') }}
            </div>
            <br>
        @endif
        <form method="post" action="{{ route('admin.cars.store') }}">
            @csrf

            <div class="form-group">
                @error('email')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="email">E-mail клиента</label>
                <input type="email" name="email" class="form-control">
            </div>

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
