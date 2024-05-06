<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Retention extends BaseController
{
    protected $retention;
    protected $patient;
    protected $breadcrumbs;
    protected $preservation;


    public function __construct()
    {
        $this->retention = new \App\Models\Retention();
        $this->patient = new \App\Models\Patient();
        $this->breadcrumbs = new \App\Modules\Breadcrumbs\Breadcrumbs();
        $this->preservation = new \App\Models\Preservation();
    }


    public function index()
    {
        $patients = $this->patient->findAll();
        $preservations = $this->preservation->findAll();
        foreach ($patients as $key => $patient) {
            foreach ($preservations as $preservation) {
                if ($patient['norm'] == $preservation['norm']) {
                    unset($patients[$key]);
                }
            }
        }
        $this->breadcrumbs->add('Dashboard', 'admin/dashboard');
        $this->breadcrumbs->add('Retensi', 'admin/retention');

        return view('admin/retention/index', [
            'patients' => $patients,
            'breadcrumbs' => $this->breadcrumbs->render()
        ]);
    }
}
