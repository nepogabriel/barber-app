<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Service\HourService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StartController extends Controller
{
    private HourService $hourService;

    public function __construct()
    {
        $this->hourService = new HourService();
    }

    public function index(Request $request)
    {
        $message_order_success = $request->session()->get('message.order_success');

        return view('site.start.index')
        ->with('message_order_success', $message_order_success);
    }

    public function check()
    {
        return view('site.start.check');
    }

    public function show(Request $request)
    {
        $appointments = DB::table('appointments')
            ->join('hours', 'appointments.hour_id', '=', 'hours.id')
            ->join('professionals', 'hours.professional_id', '=', 'professionals.id')
            ->select('appointments.telephone_client', 'hours.date', 'hours.time', 'professionals.name')
            ->where('appointments.telephone_client', $request->telephone_client)
            ->whereRaw('date >= CURDATE() - INTERVAL 1 DAY')
            ->orderBy('hours.date')
            ->orderBy('hours.time')
            ->get();

        if (isset($appointments) && $appointments->isNotEmpty()) {
            foreach ($appointments as $key => $appointment) {
                $appointments[$key]->date = $this->hourService->formatDate($appointment->date);
                $appointments[$key]->time = $this->hourService->formatTime($appointment->time);
            }
        }

        return view('site.start.check')
            ->with('appointments', $appointments);
    }
}
