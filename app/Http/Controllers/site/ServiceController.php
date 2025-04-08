<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Requests\site\ServiceFormRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::query()->orderBy('name')->get();

        foreach ($services as $service) {
            $service->price = str_replace('.', ',', $service->price);
        }

        $order_service_id = $request->session()->get('order.service_id');
        $message_order_success = $request->session()->get('message.order_success');

        return view('site.service.index')
            ->with('services', $services)
            ->with('order_service_id', $order_service_id)
            ->with('message_order_success', $message_order_success);
    }

    public function store(ServiceFormRequest $request)
    {
        $request->session()->put('order.service_id', $request->service_id);

        return to_route('site.professional.index');
    }
}
