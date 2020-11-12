@extends('layout')

@section('title', 'Все автомобили')

@section('content')
    <div class="container">
        <a href="{{ route('admin.panel') }}" style="margin-top: 20px" class="btn btn-danger btn-lg btn-block">Административная
            панель</a>
    </div>
    <br>
    <div class="container" style="margin-left: auto; margin-right: auto">
        @if(Session::has('successful car delete'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('successful car delete') }}
            </div>
        @endif
        @if(Session::has('successful car create'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('successful car create') }}
            </div>
        @endif

        <p><a href="{{ route('admin.cars.create') }}" class="btn btn-lg btn-success" style="margin-top: 10px">Добавить
                автомобиль клиента</a></p>

        <div class="btn-group" style="margin-bottom: 20px; margin-top: 10px">
            <button type="button" class="btn btn-info btn-lg dropdown-toggle" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                Сортировать
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('admin.cars.index', ['orderBy' => 'По_марке']) }}">По марке</a>
                <a class="dropdown-item"
                   href="{{ route('admin.cars.index', ['orderBy' => 'По_году_выпуска_(сначала_новые)']) }}">По году
                    выпуска (сначала новые)</a>
                <a class="dropdown-item"
                   href="{{ route('admin.cars.index', ['orderBy' => 'По_году_выпуска_(сначала_старые)']) }}">По году
                    выпуска (сначала старые)</a>
                <a class="dropdown-item"
                   href="{{ route('admin.cars.index', ['orderBy' => 'По_году_выпуска_(только_2000+)']) }}">По году
                    выпуска (только 2000+)</a>
                <a class="dropdown-item"
                   href="{{ route('admin.cars.index', ['orderBy' => 'По_году_выпуска_(только_1980+)']) }}">По году
                    выпуска (только 1980+)</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('admin.cars.index', ['orderBy' => null]) }}">Все</a>
            </div>
        </div>

        @if($orderBy === null)
            <h3 class="text-center">Все автомобили</h3>
        @else
            <h3 class="text-center">Автомобили
                отсортированы {{ \Illuminate\Support\Str::lower(str_replace('_', ' ', $orderBy)) }}</h3>
        @endif
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Владелец</th>
                <th scope="col">Марка</th>
                <th scope="col">Модель</th>
                <th scope="col">vin-код</th>
                <th scope="col">Год выпуска</th>
                <th scope="col">Цвет</th>
                <th scope="col">Удалить</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cars as $car)
                <tr>
                    <td><a href="{{ route('admin.users.show', ['user' => $car->user]) }}"
                           class="btn btn-link">{{ $car->user->name }}</a></td>
                    <td>{{ $car->make }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->vin }}</td>
                    <td>{{ $car->year }}</td>
                    <td>{{ $car->colour }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.cars.destroy', ['car' => $car]) }}">
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
