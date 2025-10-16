<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Requests\site\HourFormRequest;
use App\Services\HourControlService;
use App\Services\HourService;
use App\Services\ServiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HourController extends Controller
{
    public function __construct(
        private HourService $hour_service,
        private HourControlService $hour_control_service,
        private ServiceService $service_service
    ) {}

    public function index(Request $request)
    {
        $message_alert_user = $request->session()->get('hour_control.alert_user');

        return view('site.hour.index')
            ->with('message_alert_user', $message_alert_user);
    }

    public function store(HourFormRequest $request)
    {
        try {
            $ids_hour_control_selected = $request->session()->get('order.ids_hour_control') ?: [];

            $alert_user = $this->hour_control_service->validateHourControl($request->hour_id, $ids_hour_control_selected);

            if (isset($alert_user['alert_user']) && $alert_user['alert_user']) {
                $message_alert_user = $alert_user['message'] ?: 'Desculpe! Outro usuário escolheu o mesmo horário.';

                return to_route('site.hour.index')
                    ->with('hour_control.alert_user', $message_alert_user); 
            }

            $this->hour_control_service->hourControl($request->hour_id);

            $hours_id = array_map('intval', $request->hour_id);
            $request->session()->put('order.hour_id', $hours_id);

            return to_route('site.client.index');
        } catch (\Exception $exception) {
            Log::critical('Aconteceu algo inesperado com os horários.', [
                'key' => 'log_hour',
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ]);

            return to_route('site.hour.index')
                ->with('hour_control.alert_user', 'Ops! Aconteceu algo inesperado, tente novamente ou mais tarde.');
        }
    }

    public function show(Request $request)
    {
        try {
            $order_professional_id = $request->session()->get('order.professional_id');
            $order_hour_id = $request->session()->get('order.hour_id') ?: [];

            $hours = $this->hour_service->getHours($order_professional_id, $request->date);

            $services = '';

            if ($request->session()->get('order.service_id') !== null) {
                $services = $this->service_service->getNameOfServices($request->session()->get('order.service_id'));
            }

            $data = [
                'order_hour_id' => $order_hour_id,
                'order_professional_id' => $order_professional_id,
                'hours' => $hours,
                'services' => $services,
            ];

            return response()->json($data);
        } catch (\Exception $exception) {
            Log::critical('Aconteceu algo inesperado ao buscar horário marcado.', [
                'key' => 'log_hour',
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ]);

            return to_route('site.start.index')
                ->with('message.order_success', 'Ops! Aconteceu algo inesperado, tente novamente ou mais tarde.');
        }
    }
}
