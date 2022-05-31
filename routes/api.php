<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
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
//API route for register new user
Route::post('/register', [AuthController::class, 'register']);
//API route for login user
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/category', [CategoryController::class, 'index']); //menampilkan seluruh data
Route::post('/category', [CategoryController::class, 'store']); //menambahkan data
Route::get('/category/{categoryId}', [CategoryController::class, 'show']);
Route::put('/category/{categoryId}', [CategoryController::class, 'update']);
Route::delete('/category/{categoryId}', [CategoryController::class, 'destroy']);
