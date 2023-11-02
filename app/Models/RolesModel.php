<?php

namespace App\Models;

use App\Entities\RolesEntity;
use CodeIgniter\Model;

class RolesModel extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'uuid'];
    protected $returnType = RolesEntity::class;
    protected $useTimestamps = false;
    protected $useSoftDeletes = false;
    protected $skipValidation = false;
}