<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Requests\site\HourFormRequest;
use App\Http\Service\HourService;
use App\Models\Hour;
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
}
