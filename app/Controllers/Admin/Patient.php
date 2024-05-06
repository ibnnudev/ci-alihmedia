<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Patient as ModelsPatient;
use App\Modules\Breadcrumbs\Breadcrumbs;

class Patient extends BaseController
{
    protected $breadcrumbs;
    protected $patient;

    public function __construct()
    {
        $this->breadcrumbs = new Breadcrumbs();
        $this->patient     = new ModelsPatient();
    }

    public function index()
    {
        $breadcrumbs = $this->breadcrumbs;
        $breadcrumbs->add('Dashboard', 'admin/dashboard');
        $breadcrumbs->add('Pasien', 'admin/patient');

        $patients = $this->patient->findAll();
        return view('admin/patient/index', [
            'patients'    => $patients,
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
            'data'        => $data,
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
            'norm'        => $norm
        ]);
    }

    public function store()
    {
        try {
            $data               = $this->request->getPost();
            $data['norm']       = $this->patient->generateNorm();
            $data['age']        = date('Y') - explode('-', $data['birth_date'])[0];
            $data['created_at'] = date('Y-m-d H:i:s');
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
            'data'        => $data,
            'breadcrumbs' => $this->breadcrumbs->render()
        ]);
    }

    public function update($norm)
    {
        try {
            $data               = $this->request->getPost();
            $data['age']        = date('Y') - explode('-', $data['birth_date'])[0];
            $data['created_at'] = date('Y-m-d H:i:s');
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

    public function import()
    {
        $file = $this->request->getFile('file');
        $ext  = $file->getClientExtension();
        if ($ext != 'xlsx') {
            session()->setFlashdata('message', ['error', 'File yang diupload harus berformat .xlsx']);
            return redirect()->to('/admin/patient');
        }

        $reader      = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($file);
        $sheet       = $spreadsheet->getActiveSheet();
        $rows        = $sheet->toArray();

        $data = [];
        foreach ($rows as $key => $row) {
            if ($key == 0) {
                continue;
            }

            $this->patient->insert([
                'norm'        => $this->patient->generateNorm(),
                'name'        => $row[0],
                'nik'         => $row[1],
                'address'     => $row[2],
                'gender'      => $row[3],
                'birth_place' => $row[4],
                'birth_date'  => $row[5],
                'age'         => $row[6],
                'religion'    => $row[7],
                'district'    => $row[8],
                'village'     => $row[9],
                'regency'     => $row[10],
                'diagnose'    => $row[11],
                'created_at'  => date('Y-m-d H:i:s')
            ]);
        }

        session()->setFlashdata('message', ['success', 'Data pasien berhasil diimport']);
        return redirect()->to('/admin/patient');
    }
}
