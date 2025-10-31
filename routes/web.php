<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::home')->middleware('auth')->name('home');
Route::livewire('/login', 'pages::auth.login')->middleware('guest')->name('login');