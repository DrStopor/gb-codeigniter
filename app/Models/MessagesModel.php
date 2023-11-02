<?php

namespace App\Models;

use App\Entities\MessagesEntity;
use CodeIgniter\Model;

class MessagesModel extends Model
{
    protected $table = 'messages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['message', 'uuid', 'user_id', 'created_at', 'updated_at'];
    protected $returnType = MessagesEntity::class;
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;
    protected $skipValidation = false;
}