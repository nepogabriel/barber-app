<?php

namespace App\Infra;

use App\Interfaces\SessionInterface;
use Illuminate\Http\Request;

class LaravelSession implements SessionInterface
{
    public function __construct(
        private Request $request
    ) {}

    public function get(string $key, $default = null): mixed
    {
        return $this->request->session()->get($key, $default);
    }

    public function put(string $key, $value): void
    {
        $this->request->session()->put($key, $value);
    }

    public function forget(string $key): void
    {
        $this->request->session()->forget($key);
    }
}