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

Route::get('/wardata', [\App\Http\Controllers\WarDataController::class,'loadWarData'])
    ->name('war_data.show');

Route::get('/mapdata', [\App\Http\Controllers\WarDataController::class,'loadMaps'])
     ->name('map_data.show');

