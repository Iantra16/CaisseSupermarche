<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UtilisateurSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'login'    => 'admin',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
                'role'     => 'admin',
            ],
        ];
        $this->db->table('utilisateur')->truncate();
        $this->db->table('utilisateur')->insertBatch($data);

    }
}