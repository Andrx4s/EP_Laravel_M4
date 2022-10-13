<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditParametrsValidationRequest extends FormRequest
{
    /**
     * Определаят авторизован ли пользователь для выполнения запроса
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Правила проверки для аттрибутов
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:telegram_settings,name' . $this->route()->parameter('telegramSetting', 0),
            'val' => 'required'
        ];
    }

    /**
     *
     * Сообщение ошибки на русском языке для аттрибутов
     *
     * @return array|string[]
     */
    public function messages()
    {
        return parent::messages() + [
                'name.required' => 'Поле название настройки обязательно для заполнения',
                'name.unique' => 'Название настройки :input уже существует',
                'val.required' => 'Поле значение параметра обязательно для заполнения',
            ];
    }
}
