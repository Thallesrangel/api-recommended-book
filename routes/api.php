<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecommendationController;

Route::apiResource('user', UserController::class);
Route::apiResource('recommendation', RecommendationController::class);
