<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/create', function () { 
    return view('create');
});
Route::get('/events/create', [EventController::class,'create']);