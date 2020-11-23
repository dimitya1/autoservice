@extends('layout')

@section('title', 'Изменить данные механика')

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
        <form method="post" action="{{ route('admin.mechanics.update', ['mechanic' => $mechanic]) }}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                @error('name')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="name">ФИО</label>
                <input type="name" name="name" class="form-control"
                       value="{{ old('name', $mechanic->name) }}">
            </div>

            <div class="form-group">
                @error('email')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="email">E-Mail</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email', $mechanic->email) }}">
            </div>

            <div class="form-group">
                @error('mobile')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="mobile">Телефон</label>
                <input type="mobile" name="mobile" class="form-control"
                       value="{{ old('mobile', $mechanic->mobile_phone) }}">
            </div>

            <button type="submit" class="btn btn-primary">Подтвердить</button>
        </form>
    </div>
@endsection
