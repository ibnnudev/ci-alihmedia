<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Patient extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'norm' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'gender' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ],
            'birth_place' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'birth_date' => [
                'type' => 'DATE'
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
