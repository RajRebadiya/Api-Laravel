<?php

use App\Http\Controllers\api\Apicontroller;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [Apicontroller::class, 'register']);
Route::post('login', [Apicontroller::class, 'login']);
Route::post('payment', [Apicontroller::class, 'payment']);
Route::post('changepassword', [Apicontroller::class, 'changePassword']);
Route::post('for-pwd', [Apicontroller::class, 'for_pwd']);
Route::post('verifyOtp', [Apicontroller::class, 'verifyOtp']);
Route::post('resetPassword', [Apicontroller::class, 'resetPassword']);
Route::post('updateProfile', [Apicontroller::class, 'updateProfile']);
