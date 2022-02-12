<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BaileysController;
use App\Http\Controllers\DeviceController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'whatsapp'], function () {
    Route::post('session/add', [BaileysController::class, 'createNewSession']);
    Route::post('chat/send', [BaileysController::class, 'sendMessage']);
    Route::post('brodcast/send', [BaileysController::class, 'sendBrodcast']);
});

Route::apiResource('device', DeviceController::class);
Route::post('device/update-status', [DeviceController::class, 'updateStatus']);

Route::post('register', [AuthController::class, 'register']);