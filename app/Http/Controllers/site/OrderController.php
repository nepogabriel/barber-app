<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Service\HourService;
use App\Models\Appointment;
use App\Models\Hour;
use App\Models\Professional;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    private HourService $hourService;

    public function __construct()
    {
        $this->hourService = new HourService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $order_session = [
            'service_id' => $request->session()->get('order.service_id'),
            'professional_id' => $request->session()->get('order.professional_id'),
            'hour_id' => $request->session()->get('order.hour_id'),
            'name_client' => $request->session()->get('order.name_client'),
            'telephone_client' => $request->session()->get('order.telephone_client'),
        ];


        $order = [];

        $order['service'] = Service::query()
            ->select('id', 'name', 'price')
            ->where('id', '=', $order_session['service_id'])
            ->get();

        $order['professional'] = Professional::query()
            ->select('id', 'name')
            ->where('id', '=', $order_session['professional_id']) 
            ->get();

        $order['hour'] = Hour::query()
            ->select('id', 'date', 'time')
            ->where('id', '=', $order_session['hour_id'])
            ->get();

        $order['service'][0]->price = str_replace('.', ',', $order['service'][0]->price); 
        $order['hour'][0]->date = $this->hourService->formatDate($order['hour'][0]->date);
        $order['hour'][0]->time = $this->hourService->formatTime($order['hour'][0]->time);
        
        return view('site.order.index')
            ->with('order', $order)
            ->with('order_session', $order_session);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $appointment = Appointment::create($request->all());
        
        $hour = DB::table('hours')
              ->where('id', $request->hour_id)
              ->update(['checked' => 1]);

        if ($appointment && $hour) {
            $request->session()->forget('order');
        }

        return to_route('site.service.index')
            ->with('message.order_success', 'Agendamento confirmado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
