<?php

use App\Http\Controllers\API\LinkDashboardController;
use App\Http\Controllers\API\LinkTreeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/link-tree/{linktree}', [LinkTreeController::class, 'index']);

Route::resource('link-dashboard', LinkDashboardController::class);