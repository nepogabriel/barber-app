<?php

namespace App\Infra;

use App\Interfaces\SessionInterface;
use Illuminate\Http\Request;

class LaravelSession implements SessionInterface
{
    public function __construct(
        private Request $request
    ) {}

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->request->session()->get($key, $default);
    }

    public function put(string|array $key, mixed $value): void
    {
        $this->request->session()->put($key, $value);
    }

    public function forget(string|array $key): void
    {
        $this->request->session()->forget($key);
    }
}