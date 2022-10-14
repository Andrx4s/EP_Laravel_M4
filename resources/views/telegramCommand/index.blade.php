@extends('welcome')

@section('title', 'страница всех команд')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-12 col-md-6">
                @if(session()->has('successError'))
                    <div class="alert alert-success mt-3 mb-3">Элемент успешно удален</div>
                @endif
                <h2>Команды панели</h2>
                <a href="{{route('telegram-command.create')}}" class="btn btn-sm btn-outline-success">Создать новую команду</a>

                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>Название команды</th>
                        <th>Операции над командой</th>
                    </tr>
                    @each('telegramCommand.row', $telegramCommand, 'command', 'telegramCommand.rowEmpty')
                </table>
            </div>
            <div class="col"></div>
        </div>
    </div>
    @include('components.destroy_modal', ['nameRoute' => 'telegram-command.index'])
@endsection
