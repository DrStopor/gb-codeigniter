<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\UsersEntity;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password', 'uuid'];
    protected $returnType = UsersEntity::class;
    protected $useTimestamps = false;
    protected $useSoftDeletes = false;
    protected $skipValidation = false;
}