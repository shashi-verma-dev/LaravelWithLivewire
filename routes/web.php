<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\UserCreate;
use App\Livewire\UserList;
use App\Livewire\ApexCharts;

Route::get('/', function () {
    return view('welcome');
});

Route::get('user',UserCreate::class);
Route::get('user-list',UserList::class);
Route::get('apex-charts',ApexCharts::class);
