<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $modules = 'Deu certo!';

        $message_success = $request->session()->get('message.success');

        return view('admin.module.index', ['modules' => $modules])
            ->with('message_success', $message_success);
    }

}
