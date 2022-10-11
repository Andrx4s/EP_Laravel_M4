<?php

namespace App\Http\Controllers;

use App\Models\TelegramSetting;
use Illuminate\Http\Request;

class TelegramSettingController extends Controller
{
    /**
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $telegramSetting = TelegramSetting::all();
        return  view('telegramSetting.index', compact('telegramSetting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('telegramSetting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TelegramSetting  $telegramSetting
     * @return \Illuminate\Http\Response
     */
    public function show(TelegramSetting $telegramSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TelegramSetting  $telegramSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(TelegramSetting $telegramSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TelegramSetting  $telegramSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TelegramSetting $telegramSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TelegramSetting  $telegramSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(TelegramSetting $telegramSetting)
    {
        //
    }
}
