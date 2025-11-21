<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/events', [EventController::class, 'index'])->name('events');

Route::get('/events/{id}', function (string $id) {
    return view('pages.events.show');
})->name('event_detail');

Route::get('/my-events', function () {
    return view('pages.events.registered');
})->name('my_events');

Route::get('/profile', function () {
    return view('pages.profile.show');
})->name('profile');

Route::get('/edit-profile', function () {
    return view('pages.profile.edit');
})->name('edit_profile');
