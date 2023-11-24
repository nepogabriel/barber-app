<?php

use App\Http\Controllers\admin\HourController;
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
    Route::get('/admin/profissional', 'index')->name('admin.professional.index');
    Route::get('/admin/profissional/cadastrar', 'create')->name('admin.professional.create');
    Route::get('/admin/profissional/{professional}/editar', 'edit')->name('admin.professional.edit');
    Route::post('/admin/profissional/salvar', 'store')->name('admin.professional.store');
    Route::put('/admin/profissional/{professional}', 'update')->name('admin.professional.update');
    Route::delete('/admin/profissional/excluir/{professional}', 'destroy')->name('admin.professional.destroy');
});

Route::controller(ServiceController::class)->group(function() {
    Route::get('/admin/servico', 'index')->name('admin.service.index');
    Route::get('admin/servico/cadastrar', 'create')->name('admin.service.create');
    Route::get('/admin/servico/{service}/editar', 'edit')->name('admin.service.edit');
    Route::post('/admin/servico/salvar', 'store')->name('admin.service.store');
    Route::put('/admin/servico/{service}', 'update')->name('admin.service.update');
    Route::delete('/admin/servico/excluir/{service}', 'destroy')->name('admin.service.destroy');
});


Route::controller(HourController::class)->group(function() {
    Route::get('/admin/horario', 'index')->name('admin.hour.index');
    Route::get('admin/horario/cadastrar', 'create')->name('admin.hour.create');
    Route::get('/admin/horario/{hour}/editar', 'edit')->name('admin.hour.edit');
    Route::post('/admin/horario/salvar', 'store')->name('admin.hour.store');
    Route::delete('/admin/hour/excluir/{hour}', 'destroy')->name('admin.hour.destroy');
});