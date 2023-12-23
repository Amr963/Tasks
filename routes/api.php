<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiProductController;

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

Route::post('login', [ApiAuthController::class, 'login']);
Route::post('register', [ApiAuthController::class, 'register']);
Route::middleware('auth:sanctum')->post('logout', [ApiAuthcontroller::class, 'logout']);

Route::post('/product/store', [ApiProductController::class, 'store'])->middleware(['auth:sanctum']);
Route::middleware('auth:sanctum')->get('/product/index', [ApiProductController::class, 'index']);
Route::get('/product/show/{id}', [ApiProductController::class, 'show']);
Route::get('/product/test', [ApiProductController::class, 'test']);
