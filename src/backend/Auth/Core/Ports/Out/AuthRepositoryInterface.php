<?php

namespace App\Auth\Core\Ports\Out;

interface AuthRepositoryInterface
{
    public function loginAuth(string $username, string $password): array;
}
