<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Patient extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'norm' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'unique'     => true
            ],
            'nik' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100
            ],
            'address' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true
            ],
            'gender' => [
                'type'       => 'VARCHAR',
                'constraint' => 10
            ],
            'birth_place' => [
                'type'       => 'VARCHAR',
                'constraint' => 100
            ],
            'birth_date' => [
                'type' => 'DATE'
            ],
            'age' => [
                'type'       => 'INT',
                'constraint' => 3
            ],
            'religion' => [
                'type'       => 'VARCHAR',
                'constraint' => 50
            ],
            'district' => [
                'type'       => 'VARCHAR',
                'constraint' => 100
            ],
            'village' => [
                'type'       => 'VARCHAR',
                'constraint' => 100
            ],
            'regency' => [
                'type'       => 'VARCHAR',
                'constraint' => 100
            ],
        ]);

        $this->forge->addKey('norm', true);
        $this->forge->createTable('patients', true);
    }

    public function down()
    {
        $this->forge->dropTable('patients', true);
    }
}
