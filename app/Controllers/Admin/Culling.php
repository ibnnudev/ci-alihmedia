<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Culling extends BaseController
{
    protected $culling;
    protected $patient;
    protected $breadcrumb;


    public function __construct()
    {
        $this->culling = new \App\Models\Culling();
        $this->patient = new \App\Models\Patient();
        $this->breadcrumb = new \App\Modules\Breadcrumbs\Breadcrumbs();
    }


    public function index()
    {
        $cullings = $this->culling->getAll();

        $this->breadcrumb->add('Dashboard', 'admin/dashboard');
        $this->breadcrumb->add('Pemusnahan', 'admin/culling');

        return view('admin/culling/index', [
            'cullings' => $cullings,
            'breadcrumbs' => $this->breadcrumb->render()
        ]);
    }

    public function create()
    {
        $patients = $this->patient->where('created_at <', date('Y-m-d', strtotime('-5 years')))->findAll();
        // check if patient already exists in culling table
        $patients = array_filter($patients, function ($patient) {
            return !$this->culling->where('norm', $patient['norm'])->first();
        });

        $this->breadcrumb->add('Dashboard', 'admin/dashboard');
        $this->breadcrumb->add('Pemusnahan', 'admin/culling');
        $this->breadcrumb->add('Create', 'admin/culling/create');

        return view('admin/culling/create', [
            'patients' => $patients,
            'breadcrumbs' => $this->breadcrumb->render()
        ]);
    }

    public function store()
    {
        $data = $this->request->getPost();

        $this->culling->insert($data);

        session()->setFlashdata('message', ['success', 'Data berhasil disimpan']);
        return redirect()->to('/admin/culling');
    }

    public function edit($id)
    {
        $culling = $this->culling->find($id);
        $patients = $this->patient->findAll();

        $this->breadcrumb->add('Dashboard', 'admin/dashboard');
        $this->breadcrumb->add('Pemusnahan', 'admin/culling');
        $this->breadcrumb->add('Edit', 'admin/culling/edit/' . $id);

        return view('admin/culling/edit', [
            'culling' => $culling,
            'patients' => $patients,
            'breadcrumbs' => $this->breadcrumb->render()
        ]);
    }

    public function update($id)
    {
        $data = $this->request->getPost();

        $this->culling->update($id, $data);

        session()->setFlashdata('message', ['success', 'Data berhasil diubah']);
        return redirect()->to('/admin/culling');
    }

    public function delete($id)
    {
        $data = $this->culling->find($id);
        if ($data['file_upload']) {
            unlink('uploads/' . $data['file_upload']);
        }

        $this->culling->delete($id);

        session()->setFlashdata('message', ['success', 'Data berhasil dihapus']);
        return redirect()->to('/admin/culling');
    }

    public function scan($id)
    {
        $culling = $this->culling->find($id);

        $this->breadcrumb->add('Dashboard', 'admin/dashboard');
        $this->breadcrumb->add('Pemusnahan', 'admin/culling');
        $this->breadcrumb->add('Alih Media (' . (string) $culling['norm'] . ')', 'admin/culling/scan/' . $id);

        return view('admin/culling/scan', [
            'culling' => $culling,
            'breadcrumbs' => $this->breadcrumb->render()
        ]);
    }

    public function scanStore()
    {
        $file = $this->request->getFile('file');
        $id = $this->request->getPost('id');

        $filename = date('YmdHis') . '_' . $file->getRandomName();
        $file->move('uploads', $filename);

        $this->culling->update($id, [
            'scan_status' => 1,
            'file_upload' => $filename
        ]);

        session()->setFlashdata('message', ['success', 'Data berhasil disimpan']);
        return redirect()->to('/admin/culling');
    }
}
