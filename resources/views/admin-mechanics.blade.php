@extends('layout')

@section('title', 'Все механики')

@section('content')
    <div class="container">
        <a href="{{ route('admin.panel') }}" style="margin-top: 20px" class="btn btn-danger btn-lg btn-block">Административная
            панель</a>
    </div>
    <br>
    <div class="container" style="margin-left: auto; margin-right: auto">
        <div class="btn-group" style="margin-bottom: 20px; margin-top: 20px">
            <button type="button" class="btn btn-info btn-lg dropdown-toggle" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                Сортировать
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('admin.mechanics.index', ['orderBy' => 'Только_свободные']) }}">Только
                    свободные</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('admin.mechanics.index', ['orderBy' => 'Только_занятые']) }}">Только
                    занятые</a>
            </div>
        </div>

        <p>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
                    aria-expanded="false" aria-controls="collapseExample">
                Посмотреть самого результативного механика
            </button>
        </p>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <p>Механик <b> {{ $bestMechanic[0]->name }} </b> с e-mail <i>{{ $bestMechanic[0]->email }}</i> принёс наибольшую
                    прибыль в этом месяце в размере <b> {{ $bestMechanic[0]->sum . ' грн.' }} </b></p>
            </div>
        </div>
        <br>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ФИО</th>
                <th scope="col">Email</th>
                <th scope="col">Телефон</th>
                <th scope="col">Статус</th>
                <th scope="col">Время добавления</th>
                <th scope="col">Статистика</th>
                <th scope="col">Удалить</th>
            </tr>
            </thead>
            <tbody>
            @foreach($mechanics as $mechanic)
                <tr>
                    <td>{{ $mechanic->name }}</td>
                    <td>{{ $mechanic->email }}</td>
                    <td>{{ $mechanic->mobile_phone }}</td>
                    <td>{{ $mechanic->status ? 'Занят' : 'Свободен'}}</td>
                    <td>{{ $mechanic->created_at }}</td>
                    <td><a href="{{ route('admin.mechanics.show', ['mechanic' => $mechanic]) }}" class="btn btn-info">Подробнее</a>
                    </td>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.mechanics.destroy', ['mechanic' => $mechanic]) }}">
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
