<?php

namespace App\Http\Controllers\admin\settings\modules;

use App\Http\Controllers\Controller;
use App\Http\Service\SettingService;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function __construct(
        public SettingService $settingService
    ) {}

    public function index(Request $request)
    {
        $modules = 'DEU CERTO!';

        dd($modules);

        $message_success = $request->session()->get('message.success');

        return view('admin.settings.modules.footer.index', ['modules' => $modules])
            ->with('message_success', $message_success);
    }

    public function edit()
    {
        $data = $this->prepareFields();

        return view('admin.settings.modules.footer.edit')->with('data', $data);
    }

    public function store(Request $request)
    {
        $data = [
            'status' => $request->status,
            'store_address' => $request->store_address,
        ];

        $this->settingService->editSetting(SettingService::CODE_FOOTER, $data);

        return to_route('admin.settings.modules.index')
            ->with('message.success', "Alteração realizada com sucesso!");
    }

    public function prepareFields()
    {
        $fields = [
            'status' => 0,
            'store_address' => '',
        ];

        return $this->settingService->prepareFields(SettingService::CODE_FOOTER, $fields);
    }
}
