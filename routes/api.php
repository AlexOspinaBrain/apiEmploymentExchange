<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JWTController;
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

/**
 * Middleware jwt verify
 */
Route::group(['middleware' => ['jwt.verify']], function() {    
    Route::get('/offers', [ApiController::class, 'getOffers']);
    Route::post('/addoffer', [ApiController::class, 'insertOffer']);
});

/**
 * Routes without jwt verify (don't need)
 */
Route::post('/adduser', [ApiController::class, 'insertUser']);
Route::post('/login', [ApiController::class, 'login']);

/**
 * Manage inexistent routes
 */
Route::fallback(function () {
    return 'Invalid Enpoint';
});
