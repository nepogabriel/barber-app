<?php

use App\Http\Controllers\admin\ProfessionalController;
use App\Http\Controllers\admin\ServiceController;
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
    return redirect('/admin/profissional');
});

Route::get('/admin', function () {
    return redirect('/admin/profissional');
});

Route::controller(ProfessionalController::class)->group(function () {
    Route::get('/admin/profissional', 'index')->name('professional.index');
    Route::get('/admin/profissional/criar', 'create')->name('professional.create');
    Route::get('/admin/profissional/{professional}/editar', 'edit')->name('professional.edit');
    Route::post('/admin/profissional/salvar', 'store')->name('professional.store');
    Route::put('/admin/profissional/{professional}', 'update')->name('professional.update');
    Route::delete('/admin/profissional/excluir/{professional}', 'destroy')->name('professional.destroy');
});

Route::controller(ServiceController::class)->group(function() {
    Route::get('/admin/servico', 'index')->name('admin.service.index');
    Route::get('admin/servico/criar', 'create')->name('admin.service.create');
    Route::get('/admin/servico/{service}/editar', 'edit')->name('admin.service.edit');
    Route::post('/admin/servico/salvar', 'store')->name('admin.service.store');
    Route::put('/admin/servico/{service}', 'update')->name('admin.service.update');
    Route::delete('/admin/servico/excluir/{service}', 'destroy')->name('admin.service.destroy');
});
