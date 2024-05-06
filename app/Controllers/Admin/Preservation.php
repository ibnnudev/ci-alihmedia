<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Preservation extends BaseController
{
    protected $preservation;
    protected $patient;
    protected $breadcrumb;


    public function __construct()
    {
        $this->preservation = new \App\Models\Preservation();
        $this->patient = new \App\Models\Patient();
        $this->breadcrumb = new \App\Modules\Breadcrumbs\Breadcrumbs();
    }


    public function index()
    {
        $preservations = $this->preservation->getAll();

        $this->breadcrumb->add('Dashboard', 'admin/dashboard');
        $this->breadcrumb->add('Pelestarian', 'admin/preservation');

        return view('admin/preservation/index', [
            'preservations' => $preservations,
            'breadcrumbs' => $this->breadcrumb->render()
        ]);
    }

    public function create()
    {
        $patients = $this->patient->where('created_at <', date('Y-m-d', strtotime('-5 years')))->findAll();
        // check if patient already exists in preservation table
        $patients = array_filter($patients, function ($patient) {
            return !$this->preservation->where('norm', $patient['norm'])->first();
        });

        $this->breadcrumb->add('Dashboard', 'admin/dashboard');
        $this->breadcrumb->add('Pelestarian', 'admin/preservation');
        $this->breadcrumb->add('Create', 'admin/preservation/create');

        return view('admin/preservation/create', [
            'patients' => $patients,
            'breadcrumbs' => $this->breadcrumb->render()
        ]);
    }

    public function store()
    {
        $data = $this->request->getPost();

        $this->preservation->insert($data);

        session()->setFlashdata('message', ['success', 'Data berhasil disimpan']);
        return redirect()->to('/admin/preservation');
    }

    public function edit($id)
    {
        $preservation = $this->preservation->find($id);
        $patients = $this->patient->findAll();

        $this->breadcrumb->add('Dashboard', 'admin/dashboard');
        $this->breadcrumb->add('Pelestarian', 'admin/preservation');
        $this->breadcrumb->add('Edit', 'admin/preservation/edit/' . $id);

        return view('admin/preservation/edit', [
            'preservation' => $preservation,
            'patients' => $patients,
            'breadcrumbs' => $this->breadcrumb->render()
        ]);
    }

    public function update($id)
    {
        $data = $this->request->getPost();

        $this->preservation->update($id, $data);

        session()->setFlashdata('message', ['success', 'Data berhasil diubah']);
        return redirect()->to('/admin/preservation');
    }

    public function delete($id)
    {
        $this->preservation->delete($id);

        session()->setFlashdata('message', ['success', 'Data berhasil dihapus']);
        return redirect()->to('/admin/preservation');
    }

    public function scan($id)
    {
        $preservation = $this->preservation->find($id);

        $this->breadcrumb->add('Dashboard', 'admin/dashboard');
        $this->breadcrumb->add('Alih Media', 'admin/preservation');
        $this->breadcrumb->add((string) $preservation['norm'], 'admin/preservation/edit/' . $id);

        return view('admin/preservation/scan', [
            'preservation' => $preservation,
            'breadcrumbs' => $this->breadcrumb->render()
        ]);
    }
}
