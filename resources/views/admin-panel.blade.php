@extends('layout')

@section('title', 'Админ. панель')

@section('content')
    <div class="container">
        <a href="{{ route('admin.panel') }}" style="margin-top: 20px" class="btn btn-danger btn-lg btn-block">Административная панель</a>
    </div>
    <br>

    <div class="container" style="margin-bottom: 90px">

    </div>
@endsection
