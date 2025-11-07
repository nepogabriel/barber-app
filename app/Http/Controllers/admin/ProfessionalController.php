<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfessionalFormRequest;
use App\Models\Professional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfessionalController extends Controller
{
    public function index(Request $request)
    {
        $professionals = Professional::query()->orderBy('name')->get();
        $message_success = $request->session()->get('message.success');

        return view('admin.professional.index', [
            'professionals' => $professionals
        ])->with('message_success', $message_success);
    }

    public function create()
    {
        return view('admin.professional.create');
    }

    public function store(ProfessionalFormRequest $request)
    {   
        $data = $request->except(['_token']);

        $data['password'] = Hash::make($data['password']);

        $professional = Professional::create($data);

        return to_route('admin.professional.index')
            ->with('message.success', "Profissional '{$professional->name}' criado(a) com sucesso!");
    }

    public function edit(Professional $professional)
    {
        return view('admin.professional.edit')->with('professional', $professional);
    }

    public function update(Professional $professional, ProfessionalFormRequest $request)
    {
        $professional->fill($request->all());
        $professional->save();

        return to_route('admin.professional.index')->with('message.success', "Profissional '{$professional->name}' atualizado(a) com sucesso!");
    }

    public function destroy(Professional $professional)
    {
        //Professional::destroy($request->id);
        $professional->delete();

        return to_route('admin.professional.index')
            ->with('message.success', "Profissional '{$professional->name}' removido(a) com sucesso!");
    }
}
