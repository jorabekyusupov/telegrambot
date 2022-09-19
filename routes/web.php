<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelegramNewController;
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

Route::get('set-webhook', [TelegramNewController::class,'setWebHook']);
Route::get('unset-webhook', [TelegramNewController::class,'unsetWebHook']);
Route::match(['get', 'post'],'telegram/webhook', [TelegramNewController::class, 'webhook']);

