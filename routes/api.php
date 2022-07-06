<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;

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
Route::get('/charts',[ChartController::class, 'index']);
Route::get('/charts/{id}', [ChartController::class, 'show']);
Route::post('/charts', [ChartController::class, 'store']);
Route::post('/charts/{id}/answers', [ChartController::class, 'answer']);
Route::delete('/charts/{id}', [ChartController::class, 'delete']);
Route::delete('/charts/{id}/answers', [ChartController::class, 'resetAnswers']);