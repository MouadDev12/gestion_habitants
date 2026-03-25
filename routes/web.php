<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HabitantController;
use App\Http\Controllers\VilleController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('habitants', HabitantController::class);
Route::resource('villes', VilleController::class)->except(['show']);
