<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Modules\Breadcrumbs\Breadcrumbs;

class Dashboard extends BaseController
{
    private $breadcrumbs;

    public function __construct()
    {
        $this->breadcrumbs = new Breadcrumbs();
    }

    public function index()
    {
        $breadcrumbs = $this->breadcrumbs;
        $breadcrumbs->add('Dashboard', site_url('admin/dashboard'));

        return view('admin/dashboard', [
            'breadcrumbs' => $breadcrumbs->render()
        ]);
    }

    public function logout()
    {
        session()->destroy();
        session()->setFlashdata('success', 'Anda telah berhasil logout');
        return redirect()->to('/login');
    }
}
