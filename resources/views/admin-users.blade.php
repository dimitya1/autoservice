@extends('layout')

@section('title', 'Все пользователи')

@section('content')
    <div class="container">
        <a href="{{ route('admin.panel') }}" style="margin-top: 20px" class="btn btn-danger btn-lg btn-block">Административная
            панель</a>
    </div>
    <div class="container">
        <a href="{{ route('home') }}" style="margin-top: 15px" class="btn btn-info btn-lg btn-block">Пользовательская версия сайта</a>
    </div>
    <br>

    <div class="container" style="margin-left: auto; margin-right: auto">
        @if(Session::has('successful user delete'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('successful user delete') }}
            </div>
        @endif
        @if(Session::has('successful user create'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('successful user create') }}
            </div>
        @endif
        <a href="{{ route('admin.users.create') }}" class="btn btn-lg btn-success" style="margin-top: 10px">Зарегистрировать нового пользователя</a>
        <br>
        <h3>Всего клиентов <span class="badge badge-primary">{{ $users->count() }}</span></h3>
        <h3>Новых клиентов в прошлом месяце <span class="badge badge-secondary">{{ $newUsersLastMonthCount }}</span>
        </h3>
        <h3>Новых клиентов в этом месяце <span class="badge badge-success">{{ $newUsersCount }}</span></h3>
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
                    <td><a href="{{ route('admin.users.show', ['user' => $user]) }}" class="btn btn-info">Подробнее</a>
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
