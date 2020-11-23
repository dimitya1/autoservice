@extends('layout')

@section('title', 'Регистрация клиента')

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

        <br>
        @if(Session::has('duplicate email'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('duplicate email') }}
            </div>
        @endif
        <br>

        <form method="post" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="form-group">
                @error('name')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="name">ФИО</label>
                <input type="name" name="name" class="form-control">
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
                <label for="password">Пароль</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                <small id="passwordHelp" class="form-text text-muted">Пароль состоять минимум из 6 символов</small>
            </div>

            <button type="submit" class="btn btn-primary">Зарегистрировать</button>
        </form>
        <br>
    </div>
@endsection
