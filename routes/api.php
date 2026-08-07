<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ChantController;
use App\Http\Controllers\PupitreController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    // Accessible à tous les choristes connectés
    Route::get('/user', [AuthController::class, 'me']);
    Route::get('/chants', [ChantController::class, 'index']);
    Route::get('/chants/{chant}', [ChantController::class, 'show']);
    Route::get('/pupitres', [PupitreController::class, 'index']);
    Route::get('/categories', [CategorieController::class, 'index']);

    // Réservé au maître de chœur
    Route::middleware('maitre_choeur')->group(function () {
        Route::post('/chants', [ChantController::class, 'store']);
        Route::put('/chants/{chant}', [ChantController::class, 'update']);
    });
});
