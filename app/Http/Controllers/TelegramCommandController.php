<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTelegramCommandValidationRequest;
use App\Http\Requests\EditTelegramCommandValidationRequest;
use App\Models\TelegramCommand;
use Illuminate\Http\Request;

class TelegramCommandController extends Controller
{
    /**
     * Вызов страницы со всеми командами
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $telegramCommand = TelegramCommand::all();
        return view('telegramCommand.index', compact('telegramCommand'));
    }

    /**
     * Вызов шаблона создания команды
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('telegramCommand.create');
    }

    /**
     * Функция создания команды
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateTelegramCommandValidationRequest $request)
    {
        TelegramCommand::create($request->validated());
        return back()->with(['success' => true]);
    }

    /**
     * Вызов страницы с просмотром
     *
     * @param  \App\Models\TelegramCommand  $telegramCommand
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(TelegramCommand $telegramCommand)
    {
        return view('telegramCommand.show', ['command' => $telegramCommand]);
    }

    /**
     * Вызов страницы с редактированием команды
     *
     * @param  \App\Models\TelegramCommand  $telegramCommand
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(TelegramCommand $telegramCommand)
    {
        return view('telegramCommand.edit', ['command' => $telegramCommand]);
    }

    /**
     * Функция редактирования команды
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TelegramCommand  $telegramCommand
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditTelegramCommandValidationRequest $request, TelegramCommand $telegramCommand)
    {
        $telegramCommand->update($request->validated());
        return back()->with(['success' => true]);
    }

    /**
     * Функция удаления команды
     *
     * @param  \App\Models\TelegramCommand  $telegramCommand
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(TelegramCommand $telegramCommand)
    {
        $telegramCommand->delete();
        return back()->with(['successError' => true]);
    }
}
