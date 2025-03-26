<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Requests\site\HourFormRequest;
use App\Http\Service\HourService;
use App\Models\Hour;
use App\Services\Site\HourControlService;
use App\Services\Site\ServiceService;
use DateTime;
use Illuminate\Http\Request;

class HourController extends Controller
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
        $order_hour_id = $request->session()->get('order.hour_id');

        $hours = $this->getHours($request);

        $message_alert_user = $request->session()->get('hour_control.alert_user');

        return view('site.hour.index')
            ->with('hours', $hours)
            ->with('order_hour_id', $order_hour_id)
            ->with('message_alert_user', $message_alert_user);
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
    public function store(HourFormRequest $request)
    {
        $hourControlService = new HourControlService();

        $ids_hour_control_selected = $request->session()->get('order.ids_hour_control') ?: [];

        if ($hourControlService->validateHourControl($request->hour_id, $ids_hour_control_selected)) {
            $message_alert_user = 'Desculpe! Outro usuário escolheu o mesmo horário.';

            return to_route('site.hour.index')
                ->with('hour_control.alert_user', $message_alert_user); 
        }

        $hourControlService->hourControl($request);

        $request->session()->put('order.hour_id', $request->hour_id);

        return to_route('site.client.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $order_professional_id = $request->session()->get('order.professional_id');
        $order_hour_id = $request->session()->get('order.hour_id');

        $hours = $this->hourService->getHours($order_professional_id, $request->date);

        if ($request->session()->get('order.service_id') !== null) {
            $serviceService = new ServiceService();
            $services = $serviceService->getNameOfServices($request->session()->get('order.service_id'));
        }

        $data = [
            'order_hour_id' => $order_hour_id ? $order_hour_id : false, 
            'order_professional_id' => $order_professional_id,
            'hours' => $hours,
            'services' => $services,
        ];

        return response()->json($data);
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


    private function getHours(Request $request)
    {
        $order_professional_id = $request->session()->get('order.professional_id');

        $hours = Hour::query()
            ->orderBy('date')
            ->orderBy('time')
            ->where('professional_id', '=', $order_professional_id)
            //->where('date', '>=', DB::raw('curdate()'))
            ->whereRaw('date >= curdate()')
            //->whereRaw('time >= curtime()')
            ->where('checked', '=', '0')
            ->get();

        foreach ($hours as $hour) {
            $hour->date = $this->hourService->formatDate($hour->date);
            $hour->time = $this->hourService->formatTime($hour->time);
        }

        return $hours;
    }
}
