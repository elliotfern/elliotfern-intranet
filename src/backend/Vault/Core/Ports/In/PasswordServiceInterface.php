<?php

namespace App\Vault\Core\Ports\In;

interface PasswordServiceInterface
{
    public function getPasswords(int $vaultId): array;
    public function savePassword(int $userId, string $serviceName, string $password, string $type, string $url): void;
}
