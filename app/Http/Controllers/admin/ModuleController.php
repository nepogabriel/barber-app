<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Service\ModuleService;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index(Request $request)
    {
        $module_service = new ModuleService;
        $directories = $module_service->getDirectories();
        $modules = $module_service->renameDirectories($directories);

        $message_success = $request->session()->get('message.success');

        return view('admin.settings.modules.index', ['modules' => $modules])
            ->with('message_success', $message_success);
    }

}
