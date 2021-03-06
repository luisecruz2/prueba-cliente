<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

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
Route::get("client",[ClientController::class,'allClient']);
Route::post("register",[ClientController::class,'registerClient']);
Route::put("delete",[ClientController::class,'deleteClient']);
Route::post("edit",[ClientController::class,'editClient']);
Route::get("detail",[ClientController::class,'detailClient']);
