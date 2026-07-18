<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/auth/registro', function () {
    return view('auth.registro');
});

Route::get('/auth/login', function () {
    return view("auth.login");
});