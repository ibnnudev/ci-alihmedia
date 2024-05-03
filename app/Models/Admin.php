<?php

namespace App\Models;

use CodeIgniter\Model;

class Admin extends Model
{
    public function authenticate($username, $password)
    {
        $admin = $this->db->table('admins')->where('username', $username)->get()->getRowArray();

        if ($admin) {
            if (password_verify($password, $admin['password'])) {
                return $admin;
            }
        }

        return false;
    }
}
