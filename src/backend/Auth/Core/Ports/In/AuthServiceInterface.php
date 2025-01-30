<?php

namespace App\Auth\Core\Ports\In;

interface AuthServiceInterface
{
    public function loginAuth(string $username, string $password): array;
}
