@extends('layout')

@section('title', 'Заявки и работы по ним')

@section('content')
    <div class="container">
        <a href="{{ route('admin.panel') }}" style="margin-top: 20px" class="btn btn-danger btn-lg btn-block">Административная
            панель</a>
    </div>
    <br>
    <div class="container" style="margin-left: auto; margin-right: auto">
        <h3 class="text-center">Все заявки и работы по ним</h3>
        @if(Session::has('successful repair finish'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('successful repair finish') }}
            </div>
        @endif
        @if(Session::has('successful request finish'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('successful request finish') }}
            </div>
        @endif
        <div class="row" style="margin-bottom: 40px">
            <div class="col">
                <p>Навигация</p>
                {{ $requests->links() }}
            </div>
            <div class="col">
                <button type="button" class="btn btn-info" data-toggle="popover"
                        style="width: 340px; margin-top: 30px"
                        title="Чтобы посотреть подробную информацию о заявке, просто счёлкните на неё."
                        data-content="Зелёным цветом отображаются уже закрытые заявки. Серым цветом отображаются заявки, работы по которым ещё не выполнены.
                Если цвет синий, то работа кипит, и её прогресс можно увидеть.">Как оно работает
                </button>
            </div>
        </div>
        @php
            $counter = 0;
        @endphp
        @forelse($requests as $request)
            @if($request->status === 0)
                @php
                    $progressbar = 0;
                @endphp
                @foreach($request->repairs as $requestRepair)
                    @if($requestRepair->status === 1)
                        @php
                            $progressbar++
                        @endphp
                    @endif
                @endforeach
                @php
                    $progressbar = ($progressbar/($request->repairs->count())) * 100;
                @endphp
                @if($progressbar !== 0)
                    <button class="btn btn-primary btn-block" type="button" data-toggle="collapse"
                            data-target="#collapse{{ $counter }}"
                            aria-expanded="false" aria-controls="collapse{{ $counter }}">
                        Заявка № {{ $request->id ?? null}}
                        <br>Прогресс:
                    </button>
                    <div class="progress" style="margin-bottom: 15px">
                        <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated"
                             role="progressbar" style="width: {{ $progressbar }}%"
                             aria-valuenow="{{ $progressbar }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div></button>
                @else
                    <p>
                        <button class="btn btn-secondary btn-block" type="button" data-toggle="collapse"
                                data-target="#collapse{{ $counter }}"
                                aria-expanded="false" aria-controls="collapse{{ $counter }}">
                            Заявка № {{ $request->id ?? null}}</button>
                    </p>
                @endif
            @else
                <p>
                    <button class="btn btn-success btn-block" type="button" data-toggle="collapse"
                            data-target="#collapse{{ $counter }}"
                            aria-expanded="false" aria-controls="collapse{{ $counter }}">
                        Заявка № {{ $request->id ?? null}}
                    </button>
                </p>
            @endif
            <div class="collapse" id="collapse{{ $counter }}">
                <div class="card-header" style="text-align: center">
                    <a href="{{ route('admin.users.show', ['user' => $request->user]) }}"
                       class="btn btn-link"><b>Заказчик: </b>{{ $request->user->name ?? null}}</a>
                    <p>
                        <a href="{{ route('admin.mechanics.show', ['mechanic' => $request->repairs->random()->mechanic]) }}"
                           class="btn btn-link"><b>Механик: </b>{{ $request->repairs->random()->mechanic->name ?? null}}
                        </a></p>
                </div>
                <div class="card-body">
                    <h5 class="card-title" style="text-align: center">
                        <b>Автомобиль: </b>{{ ($request->car->make . ' ' . $request->car->model . ' ' . $request->car->year . ' vin: ' . $request->car->vin) ?? null}}
                    </h5>
                    @if($request->description !== null)
                        <p class="card-text" style="text-align: center"><b>Описание
                                проблемы: </b>{{ $request->description }}</p>
                    @endif
                    <h4 style="text-align: center">Работы по этой заявке</h4>
                    @foreach($request->repairs as $requestRepair)
                        <p class="card-text">
                            &#9899{{ ($requestRepair->service->category . ' ' . $requestRepair->service->name . ' ' . $requestRepair->service->price . 'грн') ?? null }}</p>
                        @if($requestRepair->status === 0)
                            <a href="{{ route('admin.repairs.edit', ['repair' => $requestRepair]) }}"
                               class="btn btn-outline-primary" style="margin-bottom: 15px">Закрыть работу</a>
                        @else
                            <a href="#" class="btn btn-success disabled" style="margin-bottom: 15px">Работа
                                выполнена {{ $requestRepair->updated_at ?? null }}</a>
                        @endif
                    @endforeach
                </div>
                <div class="card-footer text-muted" style="text-align: center">
                    @if($request->status === 1)
                        Заявка закрыта {{ $request->updated_at ?? null}}
                    @else
                        Заявка создана {{ $request->created_at ?? null}}
                        @if($progressbar == 0)
                            Клиент приедет {{ $request->date ?? null}}
                        @endif
                    @endif
                </div>
            </div>
            @php($counter++)
        @empty
            <p>Пока нет заявок</p>
        @endforelse
    </div>
@endsection
