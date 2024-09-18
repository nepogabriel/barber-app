<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private string $mensagem_success = 'Configurações atualizadas com sucesso!';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $path = public_path('css/clients');
	    $template_clients = array_diff(scandir($path), array('.', '..'));

        $templates = [];

        foreach ($template_clients as $template) {
            $templates[] = str_replace(".css", '', $template);
        }

        $settings = Setting::query()->get();

        $message_success = $request->session()->get('message.success');

        return view('admin.setting.index')
            ->with('settings', $settings)
            ->with('template_clients', $templates)
            ->with('message_success', $message_success);
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
        if ($request->setting_id !== null) {
            $this->update($request, $request->setting_id);
        } else {
            Setting::create($request->all());
        }

        return to_route('admin.setting.index')
            ->with('message.success', $this->mensagem_success);
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
        $setting = Setting::find($id);
        $setting->fill($request->all());
        $setting->save();

        return to_route('admin.setting.index',)
            ->with('message.success', $this->mensagem_success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
