<?php

namespace App\Interfaces;

interface SessionInterface
{
    public function get(string $key, mixed $default = null): mixed;
    public function put(string|array $key, mixed $value): void;
    public function forget(string|array $key): void;
}