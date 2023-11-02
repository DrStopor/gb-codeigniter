<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleDefault extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Администратор',
                'uuid' => 'admin',
            ],
            [
                'id' => 2,
                'name' => 'Пользователь',
                'uuid' => 'user',
            ]
        ];

        $this->db->table('roles')->insertBatch($data);
    }
}
