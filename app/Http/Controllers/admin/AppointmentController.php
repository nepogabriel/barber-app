<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Professional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professionals = Professional::query()->orderBy('name')->get();

        $appointments = DB::table('appointments')
            ->join('hours', 'appointments.professional_id', '=', 'hours.id')
            ->join('professionals', 'appointments.professional_id', '=', 'professionals.id')
            ->select('appointments.id', 'appointments.professional_id', 'hours.id', 'hours.date', 'hours.time', 'professionals.id', 'professionals.name')
            ->get();

            //dd($appointments);

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
