<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class MessagesEntity extends Entity
{
    protected $attributes = [
        'id' => null,
        'name' => null,
        'text' => null,
        'created_at' => null
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'text' => 'string',
        'created_at' => 'datetime'
    ];
}