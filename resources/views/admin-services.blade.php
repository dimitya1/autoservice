@extends('layout')

@section('title', 'Все услуги')

@section('content')
    <div class="container">
        <a href="{{ route('admin.panel') }}" style="margin-top: 20px" class="btn btn-danger btn-lg btn-block">Административная
            панель</a>
    </div>
    <br>
    <div class="container" style="margin-left: auto; margin-right: auto">
        @if(Session::has('successful service delete'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('successful service delete') }}
            </div>
        @endif
        @if(Session::has('successful service create'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('successful service create') }}
            </div>
        @endif
        @if(Session::has('successful service update'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('successful service update') }}
            </div>
        @endif

        <div class="container">
            <a href="{{ route('admin.services.create') }}" style="margin-top: 15px; margin-bottom: 20px"
               class="btn btn-success btn-lg">Добавить услугу</a>

            <div class="row">
                <div class="col-2">
                    <div class="btn-group-vertical">
                        @foreach(array_keys($categoriesWithButtons) as $category)
                            <a href="{{ route('admin.services.index', ['category' => str_replace(' ', '_', $category)]) }}"
                               class="{{ $categoriesWithButtons[$category] }}" role="button"
                               aria-pressed="true">{{ $category }}</a>
                        @endforeach
                    </div>
                </div>
                <div class="col-10">
                    @if($services->isEmpty())
                        <h4><b>Выберите одну из категорий</b></h4>
                    @endif
                    <div class="row">
                        @foreach($services as $service)
                            <div class="col-4">
                                <div class="card border-info mb-3" style="max-width: 18rem;">
                                    <div class="card-header">{{ $service->category }}</div>
                                    <div class="card-body text-info">
                                        <h5 class="card-title">{{ $service->price . ' грн' }}</h5>
                                        <p class="card-text">{{ $service->name }}</p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-4">
                                                <form method="POST"
                                                      action="{{ route('admin.services.destroy', ['service' => $service]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="badge badge-danger" type="submit">Удалить</button>
                                                </form>
                                            </div>
                                            <div class="col-4">
                                                <a href="{{ route('admin.services.edit', ['service' => $service]) }}"
                                                   class="badge badge-warning">Изменить</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>
    <br>
    <br>
@endsection
