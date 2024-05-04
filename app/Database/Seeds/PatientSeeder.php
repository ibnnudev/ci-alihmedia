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
                'norm' => $patient->generateNorm(), // '010120-0000'
                'name' => 'John Doe',
                'address' => 'Jl. Lorem Ipsum Dolor Sit Amet',
                'birth_place' => 'Jakarta',
                'birth_date' => '1990-01-01',
                'gender' => 'Man'
            ],
            [
                'norm' => $patient->generateNorm(), // '010120-0001'
                'name' => 'Jane Doe',
                'address' => 'Jl. Lorem Ipsum Dolor Sit Amet',
                'birth_place' => 'Jakarta',
                'birth_date' => '1990-01-01',
                'gender' => 'Woman'
            ]
        ];

        foreach ($patients as $data) {
            $patient->insert($data);
        }
    }
}
