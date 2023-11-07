<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class MessagesEntity extends Entity
{
    protected $attributes = [
        'id' => null,
        'user_id' => null,
        'message' => null,
        'created_at' => null,
        'updated_at' => null,
    ];

    protected $datamap = [
        'user_id' => 'user',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'message' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}