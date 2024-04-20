<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StartController extends Controller
{
    public function index(Request $request)
    {
        $message_order_success = $request->session()->get('message.order_success');

        return view('site.start.index')
        ->with('message_order_success', $message_order_success);
    }
}
