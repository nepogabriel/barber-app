<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Interfaces\SessionInterface;
use App\Models\Appointment;
use App\Services\HourControlService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct(
        private SessionInterface $session,
        private OrderService $order_service,
        private HourControlService $hour_control_service
    ) {}

    public function index(Request $request)
    {
        if ($this->session->get('order.service_id') == null)
            return to_route('site.order.show');

        $summary = $this->order_service->getOrderSummary();
        
        return view('site.order.index')
            ->with('summary', $summary);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'orders' => 'required',
            'professional_id' => 'required',
            'name_client' => 'required',
            'telephone_client' => 'required',
        ]);

        $this->order_service->createAppointments($validated);

        return to_route('site.order.show')
            ->with('message.order_success', 'Agendamento confirmado com sucesso!');
    }

    public function show(Request $request)
    {
        $message_order_success = $request->session()->get('message.order_success');

        return view('site.order.show')
            ->with('message', $message_order_success);
    }
}
