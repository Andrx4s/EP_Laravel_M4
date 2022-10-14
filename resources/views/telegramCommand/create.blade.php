@extends('welcome')

@section('title', 'создание новой команды')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-12 col-md-6">
                <a href="{{route('telegram-command.index')}}" class="text-secondary">Вернуться на список команд</a>
                <h2>Создание новой команды</h2>
                @if(session()->has('success'))
                    <div class="alert alert-success">Ваша команда успешно создана, можете создать новую.</div>
                @endif
                <form action="{{route('telegram-command.store')}}" method="POST">
                    @csrf
                    @include('components.input', [
                                                    'input' => [
                                                        'name' => 'command',
                                                        'label' => 'Введите навание команды по примеру: /start'
                                                        ]
                                                ])
                    @include('components.textarea', [
                                                    'input' => [
                                                        'name' => 'context',
                                                        'label' => 'Введите в текст который будет отображаться у пользователя'
                                                        ]
                                                ])
                    <input type="submit" class="btn btn-primary" value="Создать новую команду">
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
