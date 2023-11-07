<?php

namespace App\Models;

use App\Entities\MessagesEntity;
use CodeIgniter\Model;

class MessagesModel extends Model
{
    protected $table = 'messages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['message', 'user_id', 'created_at', 'updated_at'];
    protected $returnType = MessagesEntity::class;
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;
    protected $skipValidation = false;

    protected $validationRules = [
        'message' => 'required|min_length[3]|max_length[512]',
    ];

    protected $validationMessages = [
        'message' => [
            'required' => 'Поле сообщение обязательно для заполнения',
            'min_length' => 'Минимальная длина сообщения 3 символа',
            'max_length' => 'Максимальная длина сообщения 512 символов',
        ],
    ];

    protected $beforeInsert = ['cleanXss'];

    protected function cleanXss(array $data)
    {
        $data['data']['message'] = $this->request->getPost('message', FILTER_SANITIZE_STRING);

        return $data;
    }
}