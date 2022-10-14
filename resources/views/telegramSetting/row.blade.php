{{--Шаблон вывода всей информации параметров--}}
<tr>
    <td>{{$setting->name}}</td>
    <td>{{$setting->val}}</td>
    <td>
        <div class="btn-group" role="group" aria-label="Функционал программы">
            <a href="{{route('telegram-setting.edit' , $setting->id)}}" type="button" class="btn btn-sm btn-warning">Редактировать</a>
            {{--data это уневирсальный элемент хранения параметров для передачи, мы будем хранить в нем ID элемента--}}
            <button type="button"
                    class="btn btn-sm btn-danger destroy"
                    data-bs-toggle="modal"
                    data-bs-target="#GetOpenDestroyModalWindow"
                    data-id="{{$setting->id}}">Удалить</button>
        </div>
    </td>
</tr>
