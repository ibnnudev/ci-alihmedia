<?php

namespace App\Database\Seeds;

use App\Models\Patient;
use CodeIgniter\Database\Seeder;

class PatientSeeder extends Seeder
{
    public function run()
    {
        $patient = new Patient();
        $patients = [
            [
                'norm' => '0001',
                'nik' => '1234567890123456',
                'name' => 'John Doe',
                'address' => 'Jl. Lorem Ipsum Dolor Sit Amet',
                'gender' => 'L',
                'birth_place' => 'Jakarta',
                'birth_date' => '2000-01-01',
                'age' => 21,
                'religion' => 'Islam',
                'district' => 'Kebayoran Lama',
                'village' => 'Pondok Pinang',
                'regency' => 'Jakarta Selatan'
            ],
            [
                'norm' => '0002',
                'nik' => '1234567890123457',
                'name' => 'Jane Doe',
                'address' => 'Jl. Lorem Ipsum Dolor Sit Amet',
                'birth_place' => 'Jakarta',
                'birth_date' => '2000-01-02',
                'age' => 21,
                'religion' => 'Islam',
                'district' => 'Kebayoran Lama',
                'village' => 'Pondok Pinang',
                'regency' => 'Jakarta Selatan'
            ],
        ];

        foreach ($patients as $data) {
            $patient->insert($data);
        }
    }
}
