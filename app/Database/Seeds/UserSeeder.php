<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $admin = [
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'username' => 'admin',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'position' => 'Admin',
            'level' => 'admin',
        ];

        $this->db->table('users')->insert($admin);

        $user = [
            'name' => 'User',
            'email' => 'user@mail.com',
            'username' => 'user',
            'password' => password_hash('user', PASSWORD_DEFAULT),
            'position' => 'User',
            'level' => 'user',
        ];

        $this->db->table('users')->insert($user);
    }
}
