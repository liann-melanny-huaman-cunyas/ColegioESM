<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ElectionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/elecciones', [ElectionController::class, 'index'])->name('elections.index');
Route::post('/elecciones/validar', [ElectionController::class, 'validateStudent'])->name('elections.validate-student');
Route::get('/elecciones/candidatos', [ElectionController::class, 'getCandidates'])->name('elections.candidates');
Route::post('/elecciones/votar', [ElectionController::class, 'submitVote'])->name('elections.vote');