<?php

namespace App\Models\Tables;

class CommonTable {
    // Configuración para la tabla `clients`
    public const CLIENTS = [
        'tableName' => 'clients',
        'fields' => [
            'id' => 'id',
            'name' => 'name',
            'email' => 'email',
            'phone' => 'phone',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',
        ],
    ];

    // Configuración para la tabla `orders`
    public const ORDERS = [
        'tableName' => 'orders',
        'fields' => [
            'id' => 'id',
            'client_id' => 'client_id',
            'total' => 'total',
            'status' => 'status',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',
        ],
    ];

     public const VAULT = [
        'tableName' => 'db_vault',
        'fields' => [
            'id' => 'id',
            'servei' => 'servei',
            'usuari' => 'usuari',
            'password' => 'password',
            'iv' => 'iv',
            'tipus' => 'tipus',
            'web' => 'web',
            'client' => 'client',
            'dateCreated' => 'dateCreated',
            'dateModified' => 'dateModified',
        ],
     ];

     public const VAULT_TYPE = [
        'tableName' => 'db_vault_type',
        'fields' => [
            'id' => 'id',
            'tipus' => 'tipus',

        ],
     ];
}
