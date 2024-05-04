<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Requests\site\HourFormRequest;
use App\Http\Service\HourService;
use App\Models\Hour;
use App\Models\HourControl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $order_professional_id = $request->session()->get('order.professional_id');
        $order_hour_id = $request->session()->get('order.hour_id');

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

        return view('site.hour.index')
            ->with('hours', $hours)
            ->with('order_hour_id', $order_hour_id);
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
        if ($this->validateHourControl($request)) {
            // Retornar para página de horários e colcoar aviso
            $message_alert_user = 'Desculpe! Outro usuário escolheu o horário.';

            return to_route('site.hour.index')
                ->with('message_alert_user', $message_alert_user); 
        }

        $this->hourControl($request);

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

        $hours = Hour::query()
            ->select('id', 'time')
            ->orderBy('time')
            ->whereRaw('date >= curdate()')
            //  ->whereRaw('time >= curtime()')
            ->where('professional_id', '=', $order_professional_id)
            ->where('date', '=', $request->date)
            ->where('checked', '=', '0')
            ->get();

        foreach ($hours as $hour) {
            $hour->time = $this->hourService->formatTime($hour->time);
        }

        $data = [
            'order_hour_id' => $order_hour_id ? $order_hour_id : false, 
            'order_professional_id' => $order_professional_id,
            'hours' => $hours
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function validateHourControl(Request $request): bool
    {
        $alert_user = false;

        $hourControl = HourControl::query()
            ->select('id', 'hour_id')
            ->where('hour_id', '=', $request->hour_id)
            ->get();
        
        if (isset($hourControl[0])) {
            $id_hour_control = $request->session()->get('order.id_hour_control');
            
            if (($id_hour_control !== null && $hourControl[0]->id !== $id_hour_control )
                || $hourControl[0]->hour_id == $request->hour_id) {
                $alert_user = true;
            }
        }

        return $alert_user;
    }

    private function hourControl(Request $request)
    {
        $condicao = $request->session()->get('order.id_hour_control') !== null;

        if ($condicao) {
            $hour_control = DB::table('hour_controls')
              ->where('id', $request->session()->get('order.id_hour_control'))
              ->update(['hour_id' => $request->hour_id]);
        } else {
            $hour_control = HourControl::create(['hour_id' => $request->hour_id]);
            $id_hour_control = $hour_control->id;

            if (isset($id_hour_control) && $id_hour_control) {
                $request->session()->put('order.id_hour_control', $id_hour_control);
            }
        }
    }
}
