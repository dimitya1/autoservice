@extends('layout')

@section('title', 'Закрыть работу')

@section('content')
    <div class="container">
        <a href="{{ route('admin.panel') }}" style="margin-top: 20px" class="btn btn-danger btn-lg btn-block">Административная
            панель</a>
    </div>
    <div class="container">
        <a href="{{ route('home') }}" style="margin-top: 15px" class="btn btn-info btn-lg btn-block">Пользовательская
            версия сайта</a>
    </div>
    <br>

    <div class="container" style="margin-bottom: 90px">
        <form method="post" action="{{ route('admin.repairs.update', ['repair' => $repair]) }}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                @error('payment')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <label for="payment">К оплате за данную работу</label>
                <input type="text" name="payment" id="payment" class="form-control"
                       value="{{ $repair->service->price }}"
                       placeholder="{{ $repair->service->price }}">
                <small id="resultHelp" class="form-text text-muted">По умолчанию устанавливается стоимость услуги.</small>
            </div>
            <div class="form-group">
                <label for="result">Опишите результат работы по автомобилю, если в этом есть необходимость</label>
                <textarea class="form-control" name="result" id="result" rows="3"></textarea>
                <small id="resultHelp" class="form-text text-muted">Необязательное поле.</small>
            </div>

            <button type="submit" class="btn btn-primary">Завершить работу</button>
        </form>
    </div>
@endsection
