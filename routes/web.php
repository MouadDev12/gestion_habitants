<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitantController;

Route::get('/', fn() => redirect()->route('habitants.index'));
Route::resource('habitants', HabitantController::class);