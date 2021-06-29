<?php

use App\Http\Controllers\HomeController;



use App\Notifications\TelegramNotif;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;
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

// Route::get('/home', function () {
//     $user = Auth::user();

//     return view('home');
// });
// Notification::route('telegram', 'TELEGRAM_CHAT_ID')
//     ->notify(new TelegramNotif());
Route::get('/', [HomeController::class, 'index']);
Route::get('/api/province/{id}/cities',[HomeController::class , 'getCities']);
Route::post('/cekresi', [HomeController::class, 'storeResi'])->name('storeResi');
Route::post('/store', [HomeController::class, 'store'])->name('store');
