<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cases extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INTEGER',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'active_ri' => [
                'type' => 'INTEGER',
                'constraint' => 11,
                'unsigned' => true
            ],
            'inactive_ri' => [
                'type' => 'INTEGER',
                'constraint' => 11,
                'unsigned' => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('cases');
    }

    public function down()
    {
        $this->forge->dropTable('cases');
    }
}
