<?php
use App\Http\Controllers\BlogController;

Route::get('/blogs', [BlogController::class, 'index']); // Tüm blogları listeler.
Route::get('/blogs/{id}', [BlogController::class, 'show']); // Belirli bir blog gösterimi .
