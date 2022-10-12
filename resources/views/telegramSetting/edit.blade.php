@extends('welcome')

@section('title', 'Редактирование настроек')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col"></div>
            <div class="col-12 col-md-6">
                @if(session()->has('success'))
                    <div class="alert alert-success">Данные успешно сохранены</div>
                @endif
                <h2>Редактирование {{$telegramSetting->name}}</h2>
                <form action="{{route('telegram-setting.update', $telegramSetting->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('components.input', ['input' => ['name' => 'name', 'label' => 'Введите название настройки, на английском', 'default' => $telegramSetting->name]])
                    @include('components.input', ['input' => ['name' => 'val', 'label' => 'Введите значение данной настройки', 'default' => $telegramSetting->val]])
                    <input type="submit" value="Отредактировать параметр" class="btn btn-sm btn-primary">
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
