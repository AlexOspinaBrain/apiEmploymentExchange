<?php

use App\Http\Controllers\ApiController;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('offers', [ApiController::class, 'getOffers']);
Route::post('addUser', [ApiController::class, 'insertUser']);
Route::post('addOffer', [ApiController::class, 'insertOffer']);

Route::fallback(function () {
    return 'Invalid Enpoint';
});