<?php

namespace App\Http\Controllers\admin\settings;

use App\Http\Controllers\Controller;
use App\Http\Service\SettingService;
use App\Models\Setting;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    private string $mensagem_success = 'Configurações atualizadas com sucesso!';

    public function __construct(
        public SettingService $settingService
    ) {}

    public function index(Request $request)
    {
        $path = public_path('css/clients');
	    $template_clients = array_diff(scandir($path), array('.', '..'));

        $templates = [];

        foreach ($template_clients as $template) {
            $templates[] = str_replace(".css", '', $template);
        }

        $settings = $this->prepareFields();

        $message_success = $request->session()->get('message.success');
        
        return view('admin.settings.general.index')
            ->with('settings', $settings)
            ->with('template_clients', $templates)
            ->with('message_success', $message_success);
    }

    public function store(Request $request)
    {
        $data = [
            'template_client' => $request->template_client,
            'order_summary' => $request->order_summary,
        ];

        if ($request->hasFile('logo_header')) {
            $image = $request->file('logo_header');

            $image_name = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('img/uploads'), $image_name);
            
            $image_path = '/img/uploads/' . $image_name;

            $data['logo_header'] = $image_path;
        }

        $this->settingService->editSetting(SettingService::CODE_GENERAL,$data);

        return to_route('admin.settings.general.index')
            ->with('message.success', $this->mensagem_success);
    }

    public function update($request_all, string $id)
    {
        $setting = Setting::find($id);
        $setting->fill($request_all);
        $setting->save();

        return to_route('admin.settings.general.index',)
            ->with('message.success', $this->mensagem_success);
    }

    public function prepareFields()
    {
        $fields = [
            'template_client' => '',
            'logo_header' => '',
            'order_summary' => 0,
        ];

        return $this->settingService->prepareFields(SettingService::CODE_GENERAL, $fields);
    }
}
