<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditParametrsValidationRequest;
use App\Http\Requests\ParametrsValidationRequest;
use App\Models\TelegramSetting;
use Illuminate\Http\Request;

class TelegramSettingController extends Controller
{
    /**
     *
     * Вызов страницы со всмеми настройками
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $telegramSetting = TelegramSetting::all();
        return  view('telegramSetting.index', compact('telegramSetting'));
    }

    /**
     * Вызова страницы для создания найстроки
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('telegramSetting.create');
    }

    /**
     * Функция для создания настройки
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ParametrsValidationRequest $request)
    {
        TelegramSetting::create($request->validated());
        return redirect()->route('telegram-setting.index')->with(['success' => true]);
    }

    /**
     * Перекидывание от куда пришел пользователь
     *
     * @param  \App\Models\TelegramSetting  $telegramSetting
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show(TelegramSetting $telegramSetting)
    {
        return back();
    }

    /**
     * Вызова страницы для редактировая найстроки
     *
     * @param  \App\Models\TelegramSetting  $telegramSetting
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(TelegramSetting $telegramSetting)
    {
        return view('telegramSetting.edit', compact('telegramSetting'));
    }

    /**
     * Функция для редактирования настройки
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TelegramSetting  $telegramSetting
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditParametrsValidationRequest $request, TelegramSetting $telegramSetting)
    {
        $telegramSetting->update($request->validated());
        return back()->with(['success' => true]);
    }

    /**
     * Удаляем элемент
     *
     * @param  \App\Models\TelegramSetting  $telegramSetting
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(TelegramSetting $telegramSetting)
    {
       $telegramSetting->delete();
       return back()->with(['successError' => true]);
    }
}
