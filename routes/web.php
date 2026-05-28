<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Adds x and y
Route::get('/addition',[CalculationController::class,'add']);

//Subtracts
Route::get('/subtraction',[CalculationController::class,'subtract']);

//Multiplys
Route::get('/multiplication',[CalculationController::class,'multiply']);

//Divides
Route::get('/division',[CalculationController::class,'divide']);
