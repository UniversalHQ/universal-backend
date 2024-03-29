<?php

use App\Http\Controllers\MapObjectController;
use App\Http\Controllers\MapRegionController;
use App\Http\Controllers\MapTextItemController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('user/me',[UserController::class,'getMe'])->middleware('auth:sanctum');

Route::get('regions',[MapRegionController::class, 'indexMap']);
Route::get('mapObjects', [MapObjectController::class, 'indexMapObject']);
Route::get('mapObjects/{mapObject}', [MapObjectController::class, 'showMapObject']);
Route::get('mapTextItem', [MapTextItemController::class, 'indexMapTextItem']);
Route::get('mapTextItem/{mapTextItem}', [MapTextItemController::class, 'showMapTextItem']);
