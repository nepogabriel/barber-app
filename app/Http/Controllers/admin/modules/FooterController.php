<?php

namespace App\Http\Controllers\admin\modules;

use App\Http\Controllers\Controller;
use App\Http\Service\SettingService;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public const CODE = 'footer';
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

        return view('admin.modules.footer.index', ['modules' => $modules])
            ->with('message_success', $message_success);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $data = $this->prepareFields();

        return view('admin.modules.footer.edit')->with('data', $data);
    }

    public function prepareFields()
    {
        $fields = [
            'store_address' => '',
        ];

        return $this->setting->prepareFields(self::CODE, $fields);
    }
}
