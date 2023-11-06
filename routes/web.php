<?php

use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\SeriesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(ProfessionalController::class)->group(function () {
    Route::get('/admin/profissional', 'index')->name('professional.index');
    Route::get('/admin/profissional/criar', 'create')->name('professional.create');
    Route::post('/admin/profissional/salvar', 'store')->name('professional.store');
    Route::delete('/admin/profissional/excluir/{id}', 'destroy')->name('professional.destroy');
});

Route::get('/series', [SeriesController::class, 'index']);
Route::get('/series/criar', [SeriesController::class, 'create']);
Route::post('/series/salvar', [SeriesController::class, 'store']);
