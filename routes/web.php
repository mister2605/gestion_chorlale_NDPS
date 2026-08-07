<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Ces deux routes restent dans web.php (et pas api.php) car c'est ce groupe
// qui vérifie le jeton CSRF envoyé par le PWA après l'appel à /sanctum/csrf-cookie.
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
