<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\cuadroController;


Route::apiResource('v1/cuadros', cuadroController::class)
    ->except(['show'])
    ->middleware('apiAcceso');
Route::get('v1/cuadros/buscar/filtro', [cuadroController::class, "search"])
    ->middleware('apiAcceso');
