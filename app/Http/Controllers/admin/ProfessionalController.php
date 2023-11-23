<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfessionalFormRequest;
use App\Models\Professional;
use Illuminate\Http\Request;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $professionals = Professional::query()->orderBy('name')->get();
        $message_success = $request->session()->get('message.success');

        return view('admin.professional.index', [
            'professionals' => $professionals
        ])->with('message_success', $message_success);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.professional.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfessionalFormRequest $request)
    {   
        $professional = Professional::create($request->all());

        return to_route('admin.professional.index')
            ->with('message.success', "Profissional '{$professional->name}' criado(a) com sucesso!");
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
    public function edit(Professional $professional)
    {
        return view('admin.professional.edit')->with('professional', $professional);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Professional $professional, ProfessionalFormRequest $request)
    {
        $professional->fill($request->all());
        $professional->save();

        return to_route('admin.professional.index')->with('message.success', "Profissional '{$professional->name}' atualizado(a) com sucesso!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Professional $professional)
    {
        //Professional::destroy($request->id);
        $professional->delete();

        return to_route('admin.professional.index')
            ->with('message.success', "Profissional '{$professional->name}' removido(a) com sucesso!");
    }
}
