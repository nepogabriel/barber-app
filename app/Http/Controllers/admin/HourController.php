<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HourFormRequest;
use App\Models\Hour;
use App\Models\Professional;
use App\Services\HourService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HourController extends Controller
{
    public function __construct(
        private HourService $hour_service
    ) {}

    public function index(Request $request)
    {
        $professionals = Professional::query()->orderBy('name')->get();
        $hours = Hour::query()->orderBy('date')->orderBy('time')->get();

        $message_success = $request->session()->get('message.success');

        return view('admin.hour.index')
            ->with('hours', $hours)
            ->with('professionals', $professionals)
            ->with('message_success', $message_success);
    }

    public function create(Hour $hour)
    {
        $professionals = Professional::query()->orderBy('name')->get();

        return view('admin.hour.create')->with('professionals', $professionals);
    }

    public function store(HourFormRequest $request)
    {
        Hour::create($request->all());

        return to_route('admin.hour.index')
            ->with('message.success', "Horário criado com sucesso!");
    }

    public function edit(Hour $hour)
    {
        $hour = DB::table('hours')
            ->join('professionals', 'hours.professional_id', '=', 'professionals.id')
            ->select('hours.id', 'hours.professional_id', 'hours.date', 'hours.time', 'professionals.name')
            ->where('hours.id', $hour->id)
            ->get();

        return view('admin.hour.edit')
            ->with('hour', $hour);
    }

    public function update(Hour $hour, HourFormRequest $request)
    {
        $hour->fill($request->all());
        $hour->save();

        return to_route('admin.hour.index')->with('message.success', "Horário atualizado com sucesso!");
    }

    public function destroy(Hour $hour)
    {
        $hour->delete();

        return to_route('admin.hour.index')
            ->with('message.success', "Horário excluído com sucesso!");
    }
}
