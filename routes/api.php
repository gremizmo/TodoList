<?php

use App\Http\Controllers\V1\Auth\AuthController;
use App\Http\Controllers\V1\User\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->namespace('V1')->group(function () {
    Route::prefix('auth')->namespace('Auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);
    });
    Route::prefix('user')->namespace('User')->group(function () {
        Route::post('store', [UserController::class, 'store']);
    });
});

Route::get('/users', function () {
    return UserResource::collection(User::paginate(10));
});
