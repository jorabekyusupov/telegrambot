<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('setwebhook', [\App\Http\Controllers\TelegramController::class, 'setWebhook']);
Route::match(['get', 'post'],\Telegram\Bot\Laravel\Facades\Telegram::getAccessToken(), [\App\Http\Controllers\TelegramController::class, 'action']);

