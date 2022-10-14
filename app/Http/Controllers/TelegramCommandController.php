<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTelegramCommandValidationRequest;
use App\Http\Requests\EditTelegramCommandValidationRequest;
use App\Models\TelegramCommand;
use Illuminate\Http\Request;

class TelegramCommandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $telegramCommand = TelegramCommand::all();
        return view('telegramCommand.index', compact('telegramCommand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('telegramCommand.create');
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     *
     * @param  \App\Models\TelegramCommand  $telegramCommand
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(TelegramCommand $telegramCommand)
    {
        return view('telegramCommand.show', ['command' => $telegramCommand]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TelegramCommand  $telegramCommand
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(TelegramCommand $telegramCommand)
    {
        return view('telegramCommand.edit', ['command' => $telegramCommand]);
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
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
