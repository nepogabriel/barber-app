<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Requests\site\ProfessionalFormRequest;
use App\Models\Professional;
use Illuminate\Http\Request;

class ProfessionalController extends Controller
{
    public function index(Request $request)
    {
        $professionals = Professional::query()->orderBy('name')->get();

        $order_professional_id = $request->session()->get('order.professional_id');

        return view('site.professional.index')
            ->with('professionals', $professionals)
            ->with('order_professional_id', $order_professional_id);
    }

    public function store(ProfessionalFormRequest $request)
    {
        $request->session()->put('order.professional_id', $request->professional_id);

        return to_route('site.hour.index');
    }
}
