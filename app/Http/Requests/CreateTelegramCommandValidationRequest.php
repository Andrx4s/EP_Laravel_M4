<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTelegramCommandValidationRequest extends FormRequest
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
            'command' => 'required|unique:telegram_commands',
            'context' => 'required'
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
                'command.required' => 'Поле название команды обязательно для заполнения',
                'command.unique' => 'Название команды :input уже существует',
                'context.required' => 'Поле текст пользователя обязательно для заполнения',
            ];
    }
}
