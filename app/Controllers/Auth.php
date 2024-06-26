<?php

namespace App\Controllers;

use App\Models\Log;
use App\Models\User;

class Auth extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        $admin = new User();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $cek = $admin->authenticate($username, $password);

        if ($cek) {
            $log = new Log();
            try {
                $log->save([
                    'user_id' => $cek['id'],
                    'activity' => 'Login',
                    'description' => $cek['name'] . '-' . $cek['level'] . ' logged in',
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            } catch (\Throwable $th) {
                throw $th;
            }

            session()->set('logged_in', true);
            session()->set('username', $cek['username']);
            session()->set('name', $cek['name']);
            session()->set('level', $cek['level']);

            return redirect()->to('admin/dashboard');
        } else {
            // Set a flash message
            session()->setFlashdata('error', 'Username atau password salah');
            return redirect()->to('/login');
        }
    }
}
