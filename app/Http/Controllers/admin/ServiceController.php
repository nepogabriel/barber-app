<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceFormRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::query()->orderBy('name')->get();
        $message_success = $request->session()->get('message.success');

        return view('admin.service.index', ['services' => $services])
            ->with('message_success', $message_success);
    }

    public function create()
    {
        return view('admin.service.create');
    }

    public function store(ServiceFormRequest $request)
    {
        $service = Service::create($request->all());

        return to_route('admin.service.index')
            ->with('message.success', "Serviço '{$service->name}' criado com sucesso!");
    }

    public function edit(Service $service)
    {
        return view('admin.service.edit')->with('service', $service);
    }

    public function update(Service $service, ServiceFormRequest $request)
    {
        $service->fill($request->all());
        $service->save();

        return to_route('admin.service.index',)
            ->with('message.success', "Serviço '{$service->name}' atualizado com sucesso!");
    }

    public function destroy(Service $service)
    {
        $service->delete();
        
        return to_route('admin.service.index')
            ->with('message.success', "Serviço '{$service->name}' removido com sucesso!");
    }
}
