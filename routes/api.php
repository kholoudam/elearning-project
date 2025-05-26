<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatsController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin/stats', [StatsController::class, 'adminStats']);
    Route::get('/enseignant/stats', [StatsController::class, 'enseignantStats']);
});
