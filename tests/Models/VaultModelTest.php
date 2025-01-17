<?php

namespace Tests\Models;

use PHPUnit\Framework\TestCase;
use App\Models\VaultModel;
use PDO;
use PDOStatement;

class VaultModelTest extends TestCase
{
    private $vaultModel;
    private $pdoMock;
    private $stmtMock;

    protected function setUp(): void
    {
        // Mock de PDO
        $this->pdoMock = $this->createMock(PDO::class);

        // Mock de PDOStatement
        $this->stmtMock = $this->createMock(PDOStatement::class);

        // Configuraciones personalizadas para las tablas
        $vaultConfig = [
            'fields' => [
                'id' => 'id',
                'servei' => 'servei',
                'usuari' => 'usuari',
                'password' => 'password',
                'tipus' => 'tipus',
                'web' => 'web',
                'client' => 'client',
                'dateCreated' => 'date_created',
                'dateModified' => 'date_modified'
            ],
            'tableName' => 'vaults'
        ];

        $vaultTypeConfig = [
            'fields' => [
                'id' => 'id',
                'tipus' => 'tipus'
            ],
            'tableName' => 'vault_types'
        ];

        // Instanciar el modelo con las dependencias simuladas
        $this->vaultModel = new VaultModel($this->pdoMock, $vaultConfig, $vaultTypeConfig);
    }

    public function testGetPasswordsReturnsCorrectData()
    {
        // Configurar el mock del PDOStatement
        $mockResult = [
            [
                'id' => 1,
                'servei' => 'Email',
                'usuari' => 'user@example.com',
                'password' => 'encrypted_password',
                'tipus_vault' => 1,
                'web' => 'https://example.com',
                'client' => 123,
                'date_created' => '2023-01-01 12:00:00',
                'date_modified' => '2023-01-02 12:00:00',
                'tipus_type' => 'Personal'
            ]
        ];

        // Simular el resultado de fetchAll
        $this->stmtMock
            ->method('fetchAll')
            ->willReturn($mockResult);

        // Simular el comportamiento de prepare y execute
        $this->pdoMock
            ->expects($this->once())
            ->method('prepare')
            ->with($this->stringContains('FROM vaults AS t1')) // Verificar que contiene la tabla esperada
            ->willReturn($this->stmtMock);

        $this->stmtMock
            ->expects($this->once())
            ->method('execute');

        // Llamar al método
        $result = $this->vaultModel->getPasswords(123);

        // Verificar los resultados
        $this->assertIsArray($result);
        $this->assertCount(1, $result);
        $this->assertEquals('Email', $result[0]['servei']);
        $this->assertEquals('user@example.com', $result[0]['usuari']);
    }

    public function testGetPasswordsReturnsNullOnFailure()
    {
        // Simular un fallo en la ejecución
        $this->stmtMock
            ->method('fetchAll')
            ->willReturn(false);

        $this->pdoMock
            ->method('prepare')
            ->willReturn($this->stmtMock);

        $this->stmtMock
            ->method('execute')
            ->willReturn(false);

        // Llamar al método
        $result = $this->vaultModel->getPasswords(999);

        // Verificar que el resultado es null
        $this->assertNull($result);
    }
}
