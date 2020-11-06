@extends('layout')

@section('title', 'Просмотр пользователя')

@section('content')
    <div class="container">
        <a href="{{ route('admin.panel') }}" style="margin-top: 20px" class="btn btn-danger btn-lg btn-block">Административная
            панель</a>
    </div>
    <br>
    <div class="container" style="margin-bottom: 90px">
        <div class="card">
            <h5 class="card-header">{{'E-Mail: ' . $user->email }}</h5>
            <div class="card-body">
                <h5 class="card-title">{{'ФИО: ' . $user->name }}</h5>
                <p class="card-text">{{'Моб. номер: ' . $user->mobile_phone }}</p>
                <form method="POST" action="{{ route('admin.users.destroy', ['user' => $user]) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Удалить</button>
                </form>
                </td>
            </div>
            <div class="card-footer text-muted">
                <p class="card-text">{{ 'Создан ' . $user->created_at }}</p>
            </div>
        </div>
    </div>
@endsection
