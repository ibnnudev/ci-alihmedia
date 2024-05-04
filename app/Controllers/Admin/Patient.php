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
}
