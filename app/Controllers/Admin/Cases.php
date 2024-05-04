<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Modules\Breadcrumbs\Breadcrumbs;
use CodeIgniter\HTTP\ResponseInterface;

class Cases extends BaseController
{
    protected $cases;
    protected $breadcrumbs;

    public function __construct()
    {
        $this->cases       = new \App\Models\Cases();
        $this->breadcrumbs = new Breadcrumbs();
    }

    public function index()
    {
        $cases = $this->cases->findAll();
        $this->breadcrumbs->add('Dashboard', 'admin/dashboard');
        $this->breadcrumbs->add('Kasus', 'admin/cases');

        return view('admin/cases/index', [
            'cases'       => $cases,
            'breadcrumbs' => $this->breadcrumbs->render()
        ]);
    }

    public function create()
    {
        $this->breadcrumbs->add('Dashboard', 'admin/dashboard');
        $this->breadcrumbs->add('Kasus', 'admin/cases');
        $this->breadcrumbs->add('Tambah Kasus', 'admin/cases/create');

        return view('admin/cases/create', [
            'breadcrumbs' => $this->breadcrumbs->render()
        ]);
    }

    public function store()
    {
        // validation
        $rules = [
            'name'        => 'required',
            'active_ri'   => 'required|numeric',
            'inactive_ri' => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('message', ['danger', $this->validator->getErrors()]);
            return redirect()->to('/admin/cases/create')->withInput();
        }

        $this->cases->save([
            'name'        => $this->request->getPost('name'),
            'active_ri'   => $this->request->getPost('active_ri'),
            'inactive_ri' => $this->request->getPost('inactive_ri')
        ]);

        session()->setFlashdata('message', ['success', 'Data berhasil disimpan']);
        return redirect()->to('/admin/cases');
    }

    public function edit($id)
    {
        $data = $this->cases->find($id);
        $this->breadcrumbs->add('Dashboard', 'admin/dashboard');
        $this->breadcrumbs->add('Kasus', 'admin/cases');
        $this->breadcrumbs->add('Edit Kasus', 'admin/cases/edit/' . $data['name']);

        return view('admin/cases/edit', [
            'data' => $data,
            'breadcrumbs' => $this->breadcrumbs->render()
        ]);
    }

    public function update($id)
    {
        // validation
        $rules = [
            'name'        => 'required',
            'active_ri'   => 'required|numeric',
            'inactive_ri' => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('message', ['danger', $this->validator->getErrors()]);
            return redirect()->to('/admin/cases/edit/' . $id)->withInput();
        }

        $this->cases->update($id, [
            'name'        => $this->request->getPost('name'),
            'active_ri'   => $this->request->getPost('active_ri'),
            'inactive_ri' => $this->request->getPost('inactive_ri')
        ]);

        session()->setFlashdata('message', ['success', 'Data berhasil diubah']);
        return redirect()->to('/admin/cases');
    }

    public function delete($id)
    {
        $this->cases->delete($id);
        session()->setFlashdata('message', ['success', 'Data berhasil dihapus']);
        return redirect()->to('/admin/cases');
    }
}
