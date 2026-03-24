<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PersonController;

Route::get('/person', [PersonController::class, 'index']);
Route::post('/person', [PersonController::class, 'store']);
Route::get('/person/{person}', [PersonController::class, 'show']);