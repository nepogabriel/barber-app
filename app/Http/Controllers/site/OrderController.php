<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Services\OrderService;
use App\Services\Site\HourControlService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct(
        private OrderService $order_service,
        private HourControlService $hour_control_service
    ) {}

    public function index(Request $request)
    {
        if ($request->session()->get('order.service_id') == null) {
            return to_route('site.order.show');
        }

        $order = $this->order_service->getOrderSummary();
        $order_session = $this->order_service->getDataSession();
        
        return view('site.order.index')
            ->with('order', $order)
            ->with('order_session', $order_session);
    }

    public function store(Request $request)
    {
        $appointment = Appointment::create($request->all());
        
        $hour = DB::table('hours')
              ->where('id', $request->hour_id)
              ->update(['checked' => 1]);

        if ($appointment && $hour) {
            $this->hour_control_service->destroyHourControl($request->hour_id);

            $request->session()->forget('order');
        }

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
