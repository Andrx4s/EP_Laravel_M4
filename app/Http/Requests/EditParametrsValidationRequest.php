<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        # Обработка внимание на файл EditParametrsValidationRequest, а именно на переписанное условие name
        return [
            'name' => [
                'required'
                    , Rule::unique('telegram_settings', 'name')
                        ->ignore($this->route('telegramSetting'))
                ],
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
                'val.required' => 'Поле значение параметра обязательно для заполнения',
            ];
    }
}
