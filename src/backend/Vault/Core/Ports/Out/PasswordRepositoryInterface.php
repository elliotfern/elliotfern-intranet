<?php

namespace App\Vault\Core\Ports\Out;

interface PasswordRepositoryInterface
{
    public function getPasswords(int $vaultId): array;
    public function getPasswordDesencrypt(int $serviceId): array;
    public function savePassword(int $userId, string $serviceName, string $password, string $type, string $url): void;
}
