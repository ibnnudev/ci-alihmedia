<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDescriptionColumnPreservation extends Migration
{
    public function up()
    {
        $this->forge->addColumn('preservation', [
            'description' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'scan_status'
            ],
            'diagnose' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
                'after' => 'norm'
            ],
        ]);

        $this->db->query('UPDATE preservation SET description = "Tidak ada deskripsi" WHERE description IS NULL');
    }

    public function down()
    {
        $this->forge->dropColumn('preservation', 'description');
    }
}
