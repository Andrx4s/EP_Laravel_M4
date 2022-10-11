<tr>
    <td>{{$setting->name}}</td>
    <td>{{$setting->val}}</td>
    <td>
        <div class="btn-group" role="group" aria-label="Функционал программы">
            <a href="{{route('telegram-setting.edit')}}" type="button" class="btn btn-primary">Редактировать</a>
            <button type="button" class="btn btn-primary">Удалить</button>
        </div>
    </td>
</tr>
