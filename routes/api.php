<?php

use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\Hotel\ImageController;
use App\Http\Controllers\Api\User\AuthentikasiController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// auth
Route::post('register', [AuthentikasiController::class, 'register']);
Route::post('login', [AuthentikasiController::class, 'login']);

Route::get('/hotel', [HotelController::class, 'index']);
Route::get('/hotel/{id}', [HotelController::class, 'show']);
Route::post('/hotel/create', [HotelController::class, 'create']);

Route::post('hotel/image/create', [ImageController::class, 'create']);
