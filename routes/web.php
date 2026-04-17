<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;
use App\Livewire\Snake;

Route::get('/', function () {
    return view('welcome');
});

// LIVEWIRE ROUTES 
Route::get('/counter', Counter::class);

// SNAKE GAME 
Route::get('/snake', Snake::class);
