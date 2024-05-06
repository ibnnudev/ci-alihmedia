<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Patient as ModelsPatient;
use App\Modules\Breadcrumbs\Breadcrumbs;
use CodeIgniter\HTTP\ResponseInterface;

class Patient extends BaseController
{
    protected $breadcrumbs;
    protected $patient;

    public function __construct()
    {
        $this->breadcrumbs = new Breadcrumbs();
        $this->patient = new ModelsPatient();
    }

    public function index()
    {
        $breadcrumbs = $this->breadcrumbs;
        $breadcrumbs->add('Dashboard', 'admin/dashboard');
        $breadcrumbs->add('Pasien', 'admin/patient');

        $patients = $this->patient->findAll();
        return view('admin/patient/index', [
            'patients' => $patients,
            'breadcrumbs' => $breadcrumbs->render()
        ]);
    }

    public function show($norm)
    {
        $data = $this->patient->where('norm', $norm)->first();
        $this->breadcrumbs->add('Dashboard', 'admin/dashboard');
        $this->breadcrumbs->add('Pasien', 'admin/patient');
        $this->breadcrumbs->add('Detail Pasien', 'admin/patient/show/' . $norm);

        return view('admin/patient/show', [
            'data' => $data,
            'breadcrumbs' => $this->breadcrumbs->render()
        ]);
    }

    public function create()
    {
        $this->breadcrumbs->add('Dashboard', 'admin/dashboard');
        $this->breadcrumbs->add('Pasien', 'admin/patient');
        $this->breadcrumbs->add('Tambah Pasien', 'admin/patient/create');

        $norm = $this->patient->generateNorm();
        return view('admin/patient/create', [
            'breadcrumbs' => $this->breadcrumbs->render(),
            'norm' => $norm
        ]);
    }

    public function store()
    {
        try {
            $data = $this->request->getPost();
            $data['norm'] = $this->patient->generateNorm();
            $data['age'] = date('Y') - explode('-', $data['birth_date'])[0];
            $this->patient->insert($data);
            session()->setFlashdata('success', 'Data pasien berhasil ditambahkan');
            return redirect()->to('/admin/patient');
        } catch (\Throwable $th) {
            session()->setFlashdata('error', $th->getMessage());
            return redirect()->to('/admin/patient/create');
        }
    }

    public function edit($norm)
    {
        $data = $this->patient->where('norm', $norm)->first();

        $this->breadcrumbs->add('Dashboard', 'admin/dashboard');
        $this->breadcrumbs->add('Pasien', 'admin/patient');
        $this->breadcrumbs->add('Edit Pasien', 'admin/patient/edit/' . $norm);
        return view('admin/patient/edit', [
            'data' => $data,
            'breadcrumbs' => $this->breadcrumbs->render()
        ]);
    }

    public function update($norm)
    {
        try {
            $data = $this->request->getPost();
            $data['age'] = date('Y') - explode('-', $data['birth_date'])[0];
            $this->patient->where('norm', $norm)->set($data)->update();
            session()->setFlashdata('message', ['success', 'Data pasien berhasil diperbarui']);
            return redirect()->to('/admin/patient');
        } catch (\Throwable $th) {
            session()->setFlashdata('message', ['error', $th->getMessage()]);
            return redirect()->to('/admin/patient/edit/' . $norm);
        }
    }

    public function delete($norm)
    {
        try {
            $this->patient->where('norm', $norm)->delete();
            session()->setFlashdata('message', ['success', 'Data pasien berhasil dihapus']);
            return redirect()->to('/admin/patient');
        } catch (\Throwable $th) {
            session()->setFlashdata('message', ['error', $th->getMessage()]);
            return redirect()->to('/admin/patient');
        }
    }
}
