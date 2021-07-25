<?php

use App\Http\Controllers\DiscordController;
use App\Http\Controllers\WarOverviewController;
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
Route::get('/current-war', WarOverviewController::class)->name('war_Overview.show');

Route::get('/discord-login', [DiscordController::class,'redirectToDiscord']);
Route::get('/discord-callback', [DiscordController::class,'callbackFromDiscord']);
