<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::livewire('/', 'pages::home')->name('home');
    Route::livewire('/posts/{post}/{slug}/{order?}', 'pages::posts.show')->name('posts.show');
    Route::livewire('/posts/{post}/{slug}/comments/{comment}', 'pages::posts.show-comment')->name('posts.show.comment');
    Route::livewire('/posts/create', 'pages::posts.create')->name('posts.create');
});

Route::middleware('guest')->group(function () {
    Route::livewire('/login', 'pages::auth.login')->name('login');
});