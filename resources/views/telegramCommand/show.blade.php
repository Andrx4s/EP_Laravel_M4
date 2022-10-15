@extends('welcome')

@section('title', 'просмотр единичной записи команды')
{{--Секция для просмотра команды--}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-12 col-md-6">
                <h2>Команда {{$command->command}}</h2>
                <label class="text-secondary small">Контекст команды</label>
                <p>{{$command->context}}</p>
                <a href="{{ route('telegram-command.index') }}" class="btn btn-sm btn-secondary">Возврат</a>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
