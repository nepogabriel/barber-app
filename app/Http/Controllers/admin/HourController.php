<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Hour;
use App\Models\Professional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $hours = DB::table('hours')
        //     ->join('professionals', 'hours.professional_id', '=', 'professionals.id')
        //     ->select('hours.date', 'hours.time', 'professionals.id')
        //     ->get();

        $professionals = Professional::query()->orderBy('name')->get();
        $hours = Hour::query()->orderBy('date')->orderBy('time')->get();

        $message_success = $request->session()->get('message.success');

        return view('admin.hour.index')
            ->with('hours', $hours)
            ->with('professionals', $professionals)
            ->with('message_success', $message_success);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Hour $hour)
    {
        // Mudar essa responsabilidade para o repositorio 
        $professionals = Professional::query()->orderBy('name')->get();

        return view('admin.hour.create')->with('professionals', $professionals);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Hour::create($request->all());

        return to_route('admin.hour.index')
            ->with('message.success', "Horário criado com sucesso!");
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
