@extends('layout')

@section('title', 'Изменить данные об услуге')

@section('content')
    <div class="container">
        <a href="{{ route('admin.panel') }}" style="margin-top: 20px" class="btn btn-danger btn-lg btn-block">Административная
            панель</a>
    </div>
    <br>
    <div class="container" style="margin-bottom: 90px">
        <form method="post" action="{{ route('admin.services.update', ['service' => $service]) }}">
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
                       value="{{ old('name2', $service->name) }}">
            </div>

            <div class="form-group">
                @error('category')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="category">Категория</label>
                <input type="category" name="category" class="form-control"
                       value="{{ old('category', $service->category) }}">
                <small id="quantityHelp" class="form-text text-muted">Только цифры.</small>
            </div>

            <div class="form-group">
                @error('price')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="price">Стоимость, грн</label>
                <input type="price" name="price" class="form-control"
                       value="{{ old('price', $service->price) }}">
                <small id="quantityHelp" class="form-text text-muted">Только цифры.</small>
            </div>

            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection
