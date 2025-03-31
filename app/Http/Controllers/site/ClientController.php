<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Requests\site\ClientFormRequest;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $name_client = $request->session()->get('order.name_client');
        $telephone_client = $request->session()->get('order.telephone_client');

        return view('site.client.index')
            ->with('name_client', $name_client)
            ->with('telephone_client', $telephone_client);
    }

    public function store(ClientFormRequest $request)
    {
        $request->session()->put('order.name_client', $request->name_client);
        $request->session()->put('order.telephone_client', $request->telephone_client);

        return to_route('site.order.index');
    }
}
