@extends('layout')

@section('title', 'Подробнее об инструменте')

@section('content')
    <div class="container">
        <a href="{{ route('admin.panel') }}" style="margin-top: 20px" class="btn btn-danger btn-lg btn-block">Административная
            панель</a>
    </div>
    <br>
    <div class="container" style="margin-bottom: 90px">
        <div class="card">
            <h5 class="card-header">{{'Количество: ' . $tool->quantity }}</h5>
            <div class="card-body">
                <h5 class="card-title">{{'Название: ' . $tool->name }}</h5>
                @if($tool->description !== null)
                    <p class="card-text">{{'Описание: ' . $tool->description }}</p>
                @else
                    <p class="card-text">Описание отсутствует</p>
                @endif
                <a href="{{ route('admin.tools.edit', ['tool' => $tool]) }}" class="btn btn-warning"
                   style="margin-bottom: 10px">Изменить</a>
                <form method="POST" action="{{ route('admin.tools.destroy', ['tool' => $tool]) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Удалить</button>
                </form>
                </td>
            </div>
            <div class="card-footer text-muted">
                @if($totalUsedQuantityThisMonth !== 0)
                    <h3>Использовано в прошлом месяце <span
                            class="badge badge-secondary">{{ $totalUsedQuantityThisMonth }}</span>
                    </h3>
                @endif
                @if($totalUsedQuantityLastMonth !== 0)
                    <h3>Использовано этом месяце <span
                            class="badge badge-primary">{{ $totalUsedQuantityThisMonth }}</span></h3>
                @endif
            </div>
        </div>
    </div>
@endsection
