<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class User extends BaseController
{
    protected $user;
    protected $breadcrumbs;

    public function __construct()
    {
        $this->user = new \App\Models\User();
        $this->breadcrumbs = new \App\Modules\Breadcrumbs\Breadcrumbs();
    }

    public function index()
    {
        $breadcrumbs = $this->breadcrumbs;
        $breadcrumbs->add('Dashboard', 'admin/dashboard');
        $breadcrumbs->add('User', 'admin/user');

        $users = $this->user->findAll();
        return view('admin/user/index', [
            'users' => $users,
            'breadcrumbs' => $breadcrumbs->render()
        ]);
    }

    public function show($id)
    {
        $data = $this->user->where('id', $id)->first();
        $this->breadcrumbs->add('Dashboard', 'admin/dashboard');
        $this->breadcrumbs->add('User', 'admin/user');
        $this->breadcrumbs->add('Detail User', 'admin/user/show/' . $id);

        return view('admin/user/show', [
            'data' => $data,
            'breadcrumbs' => $this->breadcrumbs->render()
        ]);
    }

    public function create()
    {
        $this->breadcrumbs->add('Dashboard', 'admin/dashboard');
        $this->breadcrumbs->add('User', 'admin/user');
        $this->breadcrumbs->add('Tambah User', 'admin/user/create');

        return view('admin/user/create', [
            'breadcrumbs' => $this->breadcrumbs->render()
        ]);
    }

    public function store()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|valid_email|is_unique[users.email]',
            'username' => 'required|is_unique[users.username]',
            'position' => 'required',
            'level' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/admin/user/create')->withInput()->with('validation', $this->validator);
        }

        try {
            $data = $this->request->getPost();
            $this->user->insert($data);
            return redirect()->to('/admin/user')->with('message', ['success', 'Data berhasil ditambahkan']);
        } catch (\Throwable $th) {
            return redirect()->to('/admin/user')->with('message', ['danger', 'Data gagal ditambahkan']);
        }
    }

    public function edit($id)
    {
        $data = $this->user->where('id', $id)->first();
        $this->breadcrumbs->add('Dashboard', 'admin/dashboard');
        $this->breadcrumbs->add('User', 'admin/user');
        $this->breadcrumbs->add('Edit User', 'admin/user/edit/' . $id);

        return view('admin/user/edit', [
            'data' => $data,
            'breadcrumbs' => $this->breadcrumbs->render()
        ]);
    }

    public function update($id)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|valid_email|is_unique[users.email,id,' . $id . ']',
            'username' => 'required|is_unique[users.username,id,' . $id . ']',
            'position' => 'required',
            'level' => 'required',
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('message', ['danger', $this->validator->getErrors()]);
            return redirect()->to('/admin/user/edit/' . $id);
        }

        $this->user->update($id, $this->request->getPost());
        return redirect()->to('/admin/user')->with('message', ['success', 'Data berhasil diubah']);
    }

    public function delete($id)
    {
        $this->user->delete($id);
        return redirect()->to('/admin/user')->with('message', ['success', 'Data berhasil dihapus']);
    }
}
