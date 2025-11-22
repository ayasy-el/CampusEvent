<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/events', [EventController::class, 'index'])->name('events');

Route::get('/events/{slug}', [EventController::class, 'show'])->name('event_detail');
Route::post('/events/{slug}/register', [EventController::class, 'register'])->name('events.register');

Route::get('/my-events', [EventController::class, 'registered'])->name('my_events');

Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('edit_profile');

Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
