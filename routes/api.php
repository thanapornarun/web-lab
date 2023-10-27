<?php

use App\Http\Controllers\Api\ArtistController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PlaylistController;
use App\Http\Controllers\LineController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function() {
    return [
        'hello' == 'world'
    ];
});

Route::apiResource('/artist', ArtistController::class);

Route::group([
    
    'middleware' => 'api',
    'prefix' => 'auth'
    
], function ($router) {
    
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    
});

Route::group(['middleware' => 'auth:api'], function() { 
    Route::apiResource('playlist', PlaylistController::class);
});

Route::apiResource('/lineBotx', LineController::class);

Route::post('/lineBot', [LineController::class, 'callback']);
