@extends('layout')

@section('title', 'Изменить данные')

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
        <form method="post" action="{{ route('admin.tools.update', ['tool' => $tool]) }}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                @error('name2')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="name2">Название</label>
                <input type="name2" name="name2" class="form-control"
                       value="{{ old('name2', $tool->name) }}">
            </div>

            <div class="form-group">
                @error('quantity')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="quantity">Количество</label>
                <input type="quantity" name="quantity" class="form-control"
                       value="{{ old('quantity', $tool->quantity) }}">
                <small id="quantityHelp" class="form-text text-muted">Только цифры.</small>
            </div>

            <div class="form-group">
                @error('description')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="description">Описание</label>
                <textarea class="form-control" name="description" id="description" rows="3">
                    {{ old('description', $tool->description) }}</textarea>
                <small id="descriptionHelp" class="form-text text-muted">Необязательное поле.</small>
            </div>

            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection
