<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Requests\site\ClientFormRequest;
use App\Http\Service\SettingService;
use App\Services\AppointmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    public function __construct(
        private AppointmentService $appointment_service,
    ) {}

    public function index(Request $request)
    {
        try {
            $name_client = $request->session()->get('order.name_client') ?? '';
            $telephone_client = $request->session()->get('order.telephone_client') ?? '';

            return view('site.client.index')
                ->with('name_client', $name_client)
                ->with('telephone_client', $telephone_client);   
        } catch (\Exception $exception) {
            Log::critical('Aconteceu algo inesperado ao resgatar dados do usuário na sessão.', [
                'key' => 'log_client',
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ]);

            return to_route('site.start.index')
                ->with('message.order_success', 'Ops! Aconteceu algo inesperado, tente novamente ou mais tarde.');
        }
    }

    public function store(ClientFormRequest $request)
    {
        try {
            if (!isset($request->name_client) && !isset($request->telephone_client)) {
                return view('site.client.index');
            }

            $request->session()->put('order.name_client', $request->name_client);
            $request->session()->put('order.telephone_client', $request->telephone_client);
            
            $settingService = new SettingService();
            
            if ($settingService->getSetting(SettingService::CODE_GENERAL . '_order_summary')) {
                return to_route('site.order.index');
            }

            $data = [
                'orders' => $request->session()->get('order.hour_id'),
                'professional_id' => $request->session()->get('order.professional_id'),
                'name_client' => $request->name_client,
                'telephone_client' => $request->telephone_client,
            ];

            $this->appointment_service->createAppointments($data);

            return to_route('site.order.show');
        } catch (\Exception $exception) {
            Log::critical('Aconteceu algo inesperado ao salvar dados do usuário na sessão.', [
                'key' => 'log_client',
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ]);

            return to_route('site.start.index')
                ->with('message.order_success', 'Ops! Aconteceu algo inesperado, tente novamente ou mais tarde.');
        }
    }
}
