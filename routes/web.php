<?php

use App\Http\Controllers\TelegramSettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/','main')->name('main');


Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'loginPost'])->name('login_post');

Route::middleware('auth')->group(function (){
    Route::resource('telegram-setting', TelegramSettingController::class)->parameters(['telegram-setting' => 'telegramSetting']);
});
