{{--Модальное окно которое будет обрабатывать информацию об удалении через JS измения и подставляя данные--}}
<div class="modal fade" id="GetOpenDestroyModalWindow" tabindex="-1" aria-labelledby="GetOpenDestroyModalWindow_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="GetOpenDestroyModalWindow_label">Окно подтверждения удаления</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="GetOpenDestroyModalWindow_context">
                ...
            </div>
            <div class="modal-footer">
                {{--Функционал подставки адреса автоматическии через JS--}}
                <form method="POST" id="GetOpenDestroyModalWindow_operation">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </div>
        </div>
    </div>
</div>


{{--Добавляем собвстенный скрипт--}}
@pushonce('script')
    <script>
        // Получаем идентификатор адреса ресурсов по index
        let url = '{{route($nameRoute)}}'

        // Перебираем их и накладываем на них
        let allQuerySelector = document.querySelectorAll('.destroy');

        // Перебираем их и накладываем на них слушателя на нажатие
        allQuerySelector.forEach((element) => {
            element.addEventListener('click', (el) => {

                // Получаем идентификатор из data-id
                let id = element.dataset.id;

                // Меняем текст в div с id GetOpenDestroyModalWindow_context
                let elementModalContext = document.querySelector('#GetOpenDestroyModalWindow_context')
                elementModalContext.innerText = 'Вы точно хотите удалить элемент с идентификатором ' + id;

                // Добавляем href в форму модального окна адрес ссылки по формату: url + / + id
                let elementModalForm = document.querySelector('#GetOpenDestroyModalWindow_operation');
                elementModalForm.setAttribute('action', url + '/' + id)
            })
        })
    </script>
@endpushonce
