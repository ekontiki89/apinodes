<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\NodeController;
use App\Http\Controllers\Api\V2\NodeController as v2NodeController;

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

Route::prefix('v1')->group(function (){
    Route::prefix('nodes')->group(function (){
       Route::get('/{id}/children',[NodeController::class,'children']);
        Route::get('/{id}/parents',[NodeController::class,'parents']);
    });
});

Route::prefix('v2')->group(function (){
    Route::prefix('nodes')->group(function (){
        Route::get('/{id}/children',[v2NodeController::class,'children']);
        Route::get('/{id}/parents',[v2NodeController::class,'parents']);
    });
});
