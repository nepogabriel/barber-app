<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\Hour;
use Illuminate\Http\Request;

class HourController extends Controller
{
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
            ->get();

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
    public function store(Request $request)
    {
        $request->session()->put('order.hour_id', $request->hour_id);

        //return to_route('site.hour.index'); ????
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
