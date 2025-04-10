<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login.index');
    }

    public function signIn(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:7|max:300',
        ]);

        if (!Auth::guard('professional')->attempt($credentials)) {
            return redirect()->back()->with(['alert_user' => 'Usuário ou senha inválidos.']);
        }

        return to_route('admin.appointment.index');
    }

    public function logout()
    {
        Auth::guard('professional')->logout();
        return to_route('admin.login');
    }
}
