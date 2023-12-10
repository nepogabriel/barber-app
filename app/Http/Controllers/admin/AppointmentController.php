<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Service\HourService;
use App\Models\Appointment;
use App\Models\Professional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    private HourService $hourService;

    public function __construct()
    {
        $this->hourService = new HourService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professionals = Professional::query()->orderBy('name')->get();

        $appointments = DB::table('appointments')
            ->join('professionals', 'appointments.professional_id', '=', 'professionals.id')
            ->join('hours', 'appointments.hour_id', '=', 'hours.id')
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->select('appointments.id', 'appointments.professional_id', 'appointments.name_client', 'hours.id', 'hours.date', 'hours.time', 'professionals.id', 'professionals.name', 'services.name')
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        foreach ($appointments as $appointment) {
            $appointment->date = $this->hourService->formatDate($appointment->date);
            $appointment->time = $this->hourService->formatTime($appointment->time);
        }

        return view('admin.appointment.index')
            ->with('professionals', $professionals)
            ->with('appointments', $appointments);
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
        //
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
