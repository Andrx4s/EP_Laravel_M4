@extends('welcome')

@section('title', 'создание настроек')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col"></div>
            <div class="col-12 col-md-6">
                <h2>Создание настроек</h2>
                <p>в данном разделе вы можете задать основные настройки управления вашего приложения.</p>
                @include('components.input', ['input' => ['name' => 'name', 'label' => 'Введите название настройки, на английском']])
                @include('components.input', ['input' => ['name' => 'val', 'label' => 'Введите значение данной настройки']])
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
