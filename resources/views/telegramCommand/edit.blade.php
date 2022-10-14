@extends('welcome')

@section('title', 'редактирование команды')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-12 col-md-6">
                <a href="{{route('telegram-command.index')}}" class="text-secondary">Вернуться на список команд</a>
                <h2>Редактирование команды {{$command->command}}</h2>
                @if(session()->has('success'))
                    <div class="alert alert-success">Ваша команда успешно отредактирована.</div>
                @endif
                <form action="{{route('telegram-command.update', $command->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('components.input', [
                                                    'input' => [
                                                        'name' => 'command',
                                                        'label' => 'Введите навание команды по примеру: /start',
                                                        'default' => $command->command
                                                        ]
                                                ])
                    @include('components.textarea', [
                                                    'input' => [
                                                        'name' => 'context',
                                                        'label' => 'Введите в текст который будет отображаться у пользователя',
                                                        'default' => $command->context
                                                        ]
                                                ])
                    <input type="submit" class="btn btn-primary" value="Сохранить команду">
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
