<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RetentionSchedule as ModelsRetentionSchedule;
use App\Modules\Breadcrumbs\Breadcrumbs;
use CodeIgniter\HTTP\ResponseInterface;

class RetentionSchedule extends BaseController
{
    protected $retentionSchedule;
    protected $breadcrumb;

    public function __construct()
    {
        $this->retentionSchedule = new ModelsRetentionSchedule();
        $this->breadcrumb = new Breadcrumbs();
    }

    public function index()
    {
        $retentionSchedules = $this->retentionSchedule->findAll();
        $this->breadcrumb->add('Dashboard', 'admin/dashboard');
        $this->breadcrumb->add('Jadwal Retensi', 'admin/retention-schedule');

        return view('admin/retention-schedule/index', [
            'retentions' => $retentionSchedules,
            'breadcrumbs' => $this->breadcrumb->render()
        ]);
    }

    public function create()
    {
        $this->breadcrumb->add('Dashboard', 'admin/dashboard');
        $this->breadcrumb->add('Jadwal Retensi', 'admin/retention-schedule');
        $this->breadcrumb->add('Tambah Jadwal', 'admin/retention-schedule/create');

        return view('admin/retention-schedule/create', [
            'breadcrumbs' => $this->breadcrumb->render()
        ]);
    }

    public function store()
    {
        $data = [
            'retention_date' => $this->request->getPost('retention-date')
        ];

        $this->retentionSchedule->insert($data);

        return redirect()->to('/admin/retention-schedule')->with('message', ['success', 'Data berhasil disimpan']);
    }

    public function edit($id)
    {
        $data = $this->retentionSchedule->find($id);
        $this->breadcrumb->add('Dashboard', 'admin/dashboard');
        $this->breadcrumb->add('Jadwal Retensi', 'admin/retention-schedule');
        $this->breadcrumb->add('Edit Jadwal', 'admin/retention-schedule/edit');

        return view('admin/retention-schedule/edit', [
            'data' => $data,
            'breadcrumbs' => $this->breadcrumb->render()
        ]);
    }

    public function update($id)
    {
        $data = [
            'retention_date' => $this->request->getPost('retention-date')
        ];

        $this->retentionSchedule->update($id, $data);

        return redirect()->to('/admin/retention-schedule')->with('message', ['success', 'Data berhasil diubah']);
    }

    public function delete($id)
    {
        $this->retentionSchedule->delete($id);

        return redirect()->to('/admin/retention-schedule')->with('message', ['success', 'Data berhasil dihapus']);
    }
}
