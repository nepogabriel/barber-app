<?php

use App\Http\Controllers\admin\AppointmentController;
use App\Http\Controllers\admin\HourController;
use App\Http\Controllers\admin\ProfessionalController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\site\ClientController as SiteClientController;
use App\Http\Controllers\site\HourController as SiteHourController;
use App\Http\Controllers\site\OrderController as SiteOrderController;
use App\Http\Controllers\site\ProfessionalController as SiteProfessionalController;
use App\Http\Controllers\site\ServiceController as SiteServiceController;
use App\Http\Controllers\site\StartController as SiteStartController;
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

$hash = 'a32c36de88a52ec108f6f1c5f8cc6572';

Route::get('/', function () {
    return redirect('/servicos');
});

Route::get('/a32c36de88a52ec108f6f1c5f8cc6572/admin', function () {
    return redirect('/a32c36de88a52ec108f6f1c5f8cc6572/admin/agenda');
});

Route::controller(ProfessionalController::class)->group(function () {
    Route::get('/a32c36de88a52ec108f6f1c5f8cc6572/admin/profissional', 'index')->name('admin.professional.index');
    Route::get('/a32c36de88a52ec108f6f1c5f8cc6572/admin/profissional/cadastrar', 'create')->name('admin.professional.create');
    Route::get('/a32c36de88a52ec108f6f1c5f8cc6572/admin/profissional/{professional}/editar', 'edit')->name('admin.professional.edit');
    Route::post('/a32c36de88a52ec108f6f1c5f8cc6572/admin/profissional/salvar', 'store')->name('admin.professional.store');
    Route::put('/a32c36de88a52ec108f6f1c5f8cc6572/admin/profissional/{professional}', 'update')->name('admin.professional.update');
    Route::delete('/a32c36de88a52ec108f6f1c5f8cc6572/admin/profissional/excluir/{professional}', 'destroy')->name('admin.professional.destroy');
});

Route::controller(ServiceController::class)->group(function() {
    Route::get('/a32c36de88a52ec108f6f1c5f8cc6572/admin/servico', 'index')->name('admin.service.index');
    Route::get('/a32c36de88a52ec108f6f1c5f8cc6572/admin/servico/cadastrar', 'create')->name('admin.service.create');
    Route::get('/a32c36de88a52ec108f6f1c5f8cc6572/admin/servico/{service}/editar', 'edit')->name('admin.service.edit');
    Route::post('/a32c36de88a52ec108f6f1c5f8cc6572/admin/servico/salvar', 'store')->name('admin.service.store');
    Route::put('/a32c36de88a52ec108f6f1c5f8cc6572/admin/servico/{service}', 'update')->name('admin.service.update');
    Route::delete('/a32c36de88a52ec108f6f1c5f8cc6572/admin/servico/excluir/{service}', 'destroy')->name('admin.service.destroy');
});

Route::controller(HourController::class)->group(function() {
    Route::get('/a32c36de88a52ec108f6f1c5f8cc6572/admin/horario', 'index')->name('admin.hour.index');
    Route::get('/a32c36de88a52ec108f6f1c5f8cc6572/admin/horario/cadastrar', 'create')->name('admin.hour.create');
    Route::get('/a32c36de88a52ec108f6f1c5f8cc6572/admin/horario/{hour}/editar', 'edit')->name('admin.hour.edit');
    Route::post('/a32c36de88a52ec108f6f1c5f8cc6572/admin/horario/salvar', 'store')->name('admin.hour.store');
    Route::put('/a32c36de88a52ec108f6f1c5f8cc6572/admin/horario/{hour}', 'update')->name('admin.hour.update');
    Route::delete('/a32c36de88a52ec108f6f1c5f8cc6572/admin/hour/excluir/{hour}', 'destroy')->name('admin.hour.destroy');
});

Route::controller(SiteServiceController::class)->group(function() {
    Route::get('/servicos', 'index')->name('site.service.index');
    Route::post('/servico/salvar', 'store')->name('site.service.store');
});

Route::controller(SiteProfessionalController::class)->group(function() {
    Route::get('/profissionais', 'index')->name('site.professional.index');
    Route::post('/profissional/salvar', 'store')->name('site.professional.store');
});

Route::controller(SiteHourController::class)->group(function() {
    Route::get('/horarios', 'index')->name('site.hour.index');
    Route::post('/horario/salvar', 'store')->name('site.hour.store');
    Route::post('/horarios/buscar', 'show')->name('site.hour.show');
});

Route::controller(SiteClientController::class)->group(function() {
    Route::get('/cliente', 'index')->name('site.client.index');
    Route::post('/cliente/salvar', 'store')->name('site.client.store');
});

Route::controller(SiteOrderController::class)->group(function() {
    Route::get('/pedido', 'index')->name('site.order.index');
    Route::post('/pedido/salvar', 'store')->name('site.order.store');
});

Route::controller(SiteStartController::class)->group(function() {
    Route::get('/inicio', 'index')->name('site.start.index');
});

Route::controller(AppointmentController::class)->group(function() {
    Route::get('/a32c36de88a52ec108f6f1c5f8cc6572/admin/agenda', 'index')->name('admin.appointment.index');
    Route::delete('/a32c36de88a52ec108f6f1c5f8cc6572/admin/agendamento/excluir/{appointment}', 'destroy')->name('admin.appointment.destroy');
});