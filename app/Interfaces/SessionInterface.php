<?php

namespace App\Interfaces;

interface SessionInterface
{
    public function get(string $key, $default = null): mixed;
    public function put(string $key, $value): void;
    public function forget(string $key): void;
}