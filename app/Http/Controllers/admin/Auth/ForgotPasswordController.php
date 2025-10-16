<?php

namespace App\Http\Controllers\admin\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\Auth\SendPasswordResetJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    // Exibe o formulário para pedir o link de reset
    public function showLinkRequestForm()
    {
        return view('admin.auth.forgot-password');
    }

    // Valida o e-mail, gera o token e dispara o Job
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $professional = \App\Models\Professional::where('email', $request->email)->first();

        if (!$professional) {
            return back()->withErrors(['email' => trans('passwords.user')]);
        }

        // Gera o token de redefinição de senha
        $token = Password::broker('professionals')->createToken($professional);

        // Dispara o Job para a fila
        SendPasswordResetJob::dispatch($professional, $token);

        // Retorna para a view com uma mensagem de sucesso
        return back()->with('status', trans('passwords.sent'));
    }

    // Exibe o formulário para cadastrar a nova senha
    public function showResetForm(Request $request, $token = null)
    {
        return view('admin.auth.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    // Valida e salva a nova senha
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $response = Password::broker('professionals')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($professional, $password) {
                $professional->forceFill([
                    'password' => \Illuminate\Support\Facades\Hash::make($password)
                ])->save();
            }
        );

        return $response == Password::PASSWORD_RESET
                    ? redirect()->route('admin.login')->with('status', trans('passwords.reset'))
                    : back()->withErrors(['email' => trans($response)]);
    }
}