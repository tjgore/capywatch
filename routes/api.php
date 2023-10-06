<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CapybaraController;
use App\Http\Controllers\ObservationController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::prefix('capybaras')->group(function () {
    Route::get('/', [CapybaraController::class, 'index']);

    Route::post('/', [CapybaraController::class, 'store']);

    Route::delete('/{capybara}', [CapybaraController::class, 'delete']);

    Route::put('/{capybara}', [CapybaraController::class, 'update']);
});

Route::prefix('observations')->controller(ObservationController::class)->group(function () {
    Route::get('/', 'index');

    Route::post('/', 'store')->middleware(HandlePrecognitiveRequests::class);

    Route::get('/create', 'create');

    Route::put('/{observation}', 'update');

    Route::delete('/{observation}', 'delete');
});
