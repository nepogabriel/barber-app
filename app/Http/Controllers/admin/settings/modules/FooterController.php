<?php

namespace App\Http\Controllers\admin\settings\modules;

use App\Http\Controllers\Controller;
use App\Http\Service\SettingService;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    const CODE = 'footer';
    public SettingService $setting;

    public function __construct()
    {
        $this->setting = new SettingService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $modules = 'DEU CERTO!';

        dd($modules);

        $message_success = $request->session()->get('message.success');

        return view('admin.settings.modules.footer.index', ['modules' => $modules])
            ->with('message_success', $message_success);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $data = $this->prepareFields();

        return view('admin.settings.modules.footer.edit')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->setting->editSetting(self::CODE, $request);

        return to_route('admin.settings.modules.index')
            ->with('message.success', "Alteração realizada com sucesso!");
    }

    public function prepareFields()
    {
        $fields = [
            'status' => 0,
            'store_address' => '',
        ];

        return $this->setting->prepareFields(self::CODE, $fields);
    }
}
