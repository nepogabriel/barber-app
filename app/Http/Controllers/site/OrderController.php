<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Interfaces\SessionInterface;
use App\Services\AppointmentService;
use App\Services\HourControlService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function __construct(
        private SessionInterface $session,
        private AppointmentService $appointment_service,
        private HourControlService $hour_control_service
    ) {}

    public function index(Request $request)
    {
        try {
    
            if ($this->session->get('order.service_id') == null)
                return to_route('site.order.show');

            $summary = $this->appointment_service->getOrderSummary();
            
            return view('site.order.index')
                ->with('summary', $summary);
    
        } catch (ModelNotFoundException $exception) {

            Log::critical('Conteúdo não encontrado na base de dados ao apresentar resumo do agendamento.', [
                'key' => 'log_appointment',
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ]);
    
            return view('site.order.index')
                ->with('message_alert_user', 'Ops! Aconteceu algo inesperado, tente novamente ou mais tarde.');

        } catch (\Exception $exception) {

            Log::critical('Aconteceu algo inesperado ao apresentar resumo do agendamento.', [
                'key' => 'log_appointment',
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ]);

            return view('site.order.index')
                ->with('message_alert_user', 'Ops! Aconteceu algo inesperado, tente novamente ou mais tarde.');

        }
    }

    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'orders' => 'required',
                'professional_id' => 'required',
                'name_client' => 'required',
                'telephone_client' => 'required',
            ]);

            $this->appointment_service->createAppointments($validated);

            return to_route('site.order.show')
                ->with('message.order_success', 'Agendamento confirmado com sucesso!');

        } catch (\Exception $exception) {

            Log::critical('Aconteceu algo inesperado ao registrar agendamento.', [
                'key' => 'log_appointment',
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ]);

            return view('site.order.index')
                ->with('message_alert_user', 'Ops! Aconteceu algo inesperado, tente novamente ou mais tarde.');

        }
    }

    public function show(Request $request)
    {
        try {
            $message_order_success = $request->session()->get('message.order_success');

            return view('site.order.show')
                ->with('message', $message_order_success);

        } catch (\Exception $exception) {
            Log::critical('Aconteceu algo inesperado ao mostrar confirmação do agendamento.', [
                'key' => 'log_appointment',
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ]);

            return view('site.order.index')
                ->with('message_alert_user', 'Ops! Aconteceu algo inesperado, tente novamente ou mais tarde.');
        }
    }
}
