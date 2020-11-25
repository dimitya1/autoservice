@extends('layout')

@section('title', 'Прибыль компании')

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

    <div class="container" style="margin-bottom: 120px">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <h3>Прибыль в прошлом месяце составила <span
                        class="badge badge-info">{{ $profitLastMonth . ' грн'}}</span></h3>
                <h3>Количество выполненных работ <span class="badge badge-info">{{ $repairsCountLastMonth }}</span></h3>
                @if($repairsCountLastMonth !== 0)
                    <h3>В среднем за одну роботу прибыль составила <span class="badge badge-secondary">
                            {{ round($profitLastMonth/$repairsCountLastMonth, 0) . ' грн'}}</span></h3>
                @endif
                @if(count($popularServicesLastMonth) === 1)
                    <h4>Самая популярная услуга прошлого месяца:</h4>
                    <h5>&#9899{{ $popularServicesLastMonth[0]->name }}<h5>
                @endif
                @if(count($popularServicesLastMonth) > 1)
                    <h4>Самые популярные услуги прошлого месяца:</h4>
                    @foreach($popularServicesLastMonth as $service)
                        <h5>&#9899{{ $service->name }}<h5>
                    @endforeach
                @endif
            </li>
            <li class="list-group-item">
                <h3>Прибыль в этом месяце составила <span
                        class="badge badge-success">{{ $profitThisMonth . ' грн'}}</span></h3>
                <h3>Количество выполненных работ <span class="badge badge-success">{{ $repairsCountThisMonth }}</span>
                </h3>
                @if($repairsCountThisMonth !== 0)
                    <h3>В среднем за одну роботу прибыль составила <span class="badge badge-secondary">
                            {{ round($profitThisMonth/$repairsCountThisMonth, 0) . ' грн'}}</span></h3>
                @endif
                @if(count($popularServicesThisMonth) === 1)
                    <h4>Самая популярная услуга этого месяца:</h4>
                                        <h5>&#9899{{ $popularServicesThisMonth[0]->name }}<h5>
                @endif
                @if(count($popularServicesThisMonth) > 1)
                    <h4>Самые популярные услуги этого месяца:</h4>
                    @foreach($popularServicesThisMonth as $service)
                        <h5>&#9899{{ $service->name }}<h5>
                    @endforeach
                @endif
            </li>
        </ul>
    </div>
@endsection
