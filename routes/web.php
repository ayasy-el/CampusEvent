<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/events', function () {
    return view('pages.events.index');
});

Route::get('/show', function () {
    return view('pages.events.show');
});

Route::get('/registered', function () {
    return view('pages.events.registered');
});

Route::get('/profile', function () {
    return view('pages.profile.show');
});

Route::get('/edit-profile', function () {
    return view('pages.profile.edit');
});
