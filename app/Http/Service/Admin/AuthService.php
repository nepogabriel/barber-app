<?php

namespace App\Http\Service\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthService
{
    public function signIn(array $credentials)
    {
        try {
            if (!Auth::guard('professional')->attempt($credentials))
                return false;

            return true;
        } catch (\Exception $exception) {
            Log::critical('Aconteceu algo inesperado ao efetuar o login.', [
                'key' => 'log_auth',
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ]);
            
            return false;
        }
    }

    public function logout()
    {
        return Auth::guard('professional')->logout();
    }
}