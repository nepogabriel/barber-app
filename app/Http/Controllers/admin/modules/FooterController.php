<?php

namespace App\Http\Controllers\admin\modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FooterController extends Controller
{
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

    public function edit()
    {
        $footer = 'DEU CERTO';

        return view('admin.modules.footer.edit')->with('footer', $footer);
    }
}
