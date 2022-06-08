<?php

use App\Http\Controllers\ProductController;
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

// Route::get('/products', [ProductController::class, "index"]);
Route::get('/product/detail/{id}',[ProductController::class,"detail"]);
Route::post('products/create',[ProductController::class,"create"]);
Route::delete('/product/{id}',[ProductController::class,"delete"]);
Route::post('/product/edit/{id}',[ProductController::class,"edit"]);
Route::get('/product',[ProductController::class,'index']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
