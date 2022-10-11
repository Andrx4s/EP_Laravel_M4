<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * Шаблон авторизации
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function login()
    {
        return view('user.login');
    }

    /**
     * POST запрос на обработку шаблона login
     * @param LoginValidationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginPost(LoginValidationRequest $request)
    {
        $valid = $request->validated();
        if(Auth::attempt($valid)) {
            $request->session()->regenerate();
            return redirect()->route('main');
        }

        return back()->with(['auth' => false]);
    }
}
