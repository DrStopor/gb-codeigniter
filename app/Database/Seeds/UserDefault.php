<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserDefault extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'email' => 'admin@test.test',
                'password_hash' => password_hash('admin', PASSWORD_DEFAULT),
                'id_role' => 1,
            ],
            [
                'username' => 'user',
                'email' => 'user@test.test',
                'password_hash' => password_hash('user', PASSWORD_DEFAULT),
                'id_role' => 2,
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
