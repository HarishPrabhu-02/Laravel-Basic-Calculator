<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculationController;

Route::get('/', function () {
    return view('welcome');
});
// Adds x and y
Route::get('/add/{x}/{y}',[CalculationController::class,'add']);

//Subtracts
Route::get('/subtract/{x}/{y}',[CalculationController::class,'subtract']);

//Multiplys
Route::get('/multiply/{x}/{y}',[CalculationController::class,'multiply']);

//Divides
Route::get('/divide/{x}/{y}',[CalculationController::class,'divide']);
