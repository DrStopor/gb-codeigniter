<?php

namespace App\Models;

use App\Entities\MessagesEntity;
use CodeIgniter\Model;

class MessagesModel extends Model
{
    protected $table = 'messages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['text', 'name', 'created_at'];
    protected $returnType = MessagesEntity::class;
    protected $useTimestamps = false;
    protected $useSoftDeletes = false;
    protected $skipValidation = false;

    protected $validationRules = [
        'text' => 'required|min_length[3]|max_length[512]',
        'name' => 'required|min_length[5]|max_length[255]|valid_email'
    ];

    protected $validationMessages = [
        'message' => [
            'required' => 'Поле сообщение обязательно для заполнения',
            'min_length' => 'Минимальная длина сообщения 3 символа',
            'max_length' => 'Максимальная длина сообщения 512 символов',
        ],
        'name' => [
            'required' => 'Поле "Email" обязательно для заполнения',
            'min_length' => 'Минимальная длина поля "Email" - 5 символов',
            'max_length' => 'Максимальная длина поля "Email" - 256 символов',
            'valid_email' => 'Поле "Email" должно содержать корректный email',
        ]
    ];

    protected $beforeInsert = ['cleanXss'];

    protected function cleanXss(array $data)
    {
        $data['data']['name'] = esc($data['data']['name']);
        $data['data']['created_at'] = esc($data['data']['created_at']);
        $data['data']['text'] = esc($data['data']['text']);

        return $data;
    }
}