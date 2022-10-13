{{--Шаблон вывода всей информации параметров--}}
<tr>
    <td>{{$setting->name}}</td>
    <td>{{$setting->val}}</td>
    <td>
        <div class="btn-group" role="group" aria-label="Функционал программы">
            <a href="{{route('telegram-setting.edit' , $setting->id)}}" type="button" class="btn btn-sm btn-warning">Редактировать</a>
            <button type="button" class="btn btn-sm btn-danger">Удалить</button>
        </div>
    </td>
</tr>
