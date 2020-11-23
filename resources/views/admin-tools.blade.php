@extends('layout')

@section('title', 'Все инструменты и расходники')

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
        @if(Session::has('successful tool delete'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('successful tool delete') }}
            </div>
        @endif
        @if(Session::has('successful tool create'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('successful tool create') }}
            </div>
        @endif
        @if(Session::has('successful tool update'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('successful tool update') }}
            </div>
        @endif
        <p><a href="{{ route('admin.tools.create') }}" class="btn btn-lg btn-success" style="margin-top: 10px">Добавить новую позицию</a></p>

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Название</th>
                <th scope="col">Описание</th>
                <th scope="col">Количество</th>
                <th scope="col">Статистика использования</th>
                <th scope="col">Изменить</th>
                <th scope="col">Удалить</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tools as $tool)
                <tr>
                    <td>{{ $tool->name }}</td>
                    <td>{{ $tool->description }}</td>
                    <td>{{ $tool->quantity }}</td>
                    <td><a href="{{ route('admin.tools.show', ['tool' => $tool]) }}" class="btn btn-info">Подробнее</a>
                    <td><a href="{{ route('admin.tools.edit', ['tool' => $tool]) }}"
                           class="btn btn-warning">Изменить</a>
                    </td>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.tools.destroy', ['tool' => $tool]) }}">
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
