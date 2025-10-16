<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Http\Service\Admin\AuthService;

class LoginController extends Controller
{
    public function __construct(
        private AuthService $authService
    ) {}

    public function index()
    {
        return view('admin.login.index');
    }

    public function signIn(LoginFormRequest $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:7|max:300',
        ]);

        $authenticated = $this->authService->signIn($credentials);

        if (!$authenticated) {
            return redirect()->route('admin.login')->with('alert_user', 'E-mail ou senha inválidos.');
        }

        $request->session()->regenerate();
        return to_route('admin.appointment.index');
    }

    public function logout()
    {
        $this->authService->logout();
        return to_route('admin.login');
    }
}
