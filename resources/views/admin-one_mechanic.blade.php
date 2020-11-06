@extends('layout')

@section('title', 'Просмотр механика')

@section('content')
    <div class="container">
        <a href="{{ route('admin.panel') }}" style="margin-top: 20px" class="btn btn-danger btn-lg btn-block">Административная
            панель</a>
    </div>
    <br>
    <div class="container" style="margin-bottom: 90px">
        <div class="card">
            <h5 class="card-header">{{'E-Mail: ' . $mechanic->email }}</h5>
            <div class="card-body">
                <h5 class="card-title">{{'ФИО: ' . $mechanic->name }}</h5>
                <p class="card-text">{{'Моб. номер: ' . $mechanic->mobile_phone }}</p>
                <p class="card-text">{{'Статус: ' . $mechanic->status ? 'Занят' : 'Свободен' }}</p>
                <form method="POST" action="{{ route('admin.mechanics.destroy', ['mechanic' => $mechanic]) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Удалить</button>
                </form>
                </td>
            </div>
            <div class="card-footer text-muted">
                <p class="card-text">{{ 'Создан ' . $mechanic->created_at }}</p>
            </div>
        </div>
    </div>
@endsection
