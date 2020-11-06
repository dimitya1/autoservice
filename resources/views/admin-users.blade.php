@extends('layout')

@section('title', 'Все пользователи')

@section('content')
    <div class="container">
        <a href="{{ route('admin.panel') }}" style="margin-top: 20px" class="btn btn-danger btn-lg btn-block">Административная панель</a>
    </div>
    <br>
    <div class="container" style="margin-left: auto; margin-right: auto">
        <br>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ФИО</th>
                <th scope="col">Email</th>
                <th scope="col">Телефон</th>
                <th scope="col">Время регистрации</th>
                <th scope="col">Статистика</th>
                <th scope="col">Удалить</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->mobile_phone }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td><a href="{{ route('admin.users.show', ['user' => $user]) }}" class="btn btn-info">Подробнее</a></td>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.users.destroy', ['user' => $user]) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
