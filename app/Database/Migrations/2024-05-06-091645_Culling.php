<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Culling extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'norm' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'diagnose' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'culling_date' => [
                'type' => 'DATE',
            ],
            'file_upload' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'scan_status' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('norm', 'patients', 'norm', 'CASCADE', 'CASCADE');
        $this->forge->createTable('culling');
    }

    public function down()
    {
        $this->forge->dropTable('culling');
    }
}
