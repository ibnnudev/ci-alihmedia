<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDiagnosePatientColumn extends Migration
{
    public function up()
    {
        $this->forge->addColumn('patients', [
            'diagnose' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('patients', 'diagnose');
    }
}
