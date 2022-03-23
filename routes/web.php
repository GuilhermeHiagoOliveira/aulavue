<?php

use App\Http\Controllers\BeerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InfiniteScrollController;
use Illuminate\Support\Facades\Route;



Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/infinitescroll', [InfiniteScrollController::class, 'index'])->name('infinitescroll');
Route::get('/brewery/{id}/beers', [BeerController::class, 'index'])->name('brewery.beers');
