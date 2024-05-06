<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Retention extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'norm' => [
                'type'       => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('norm', 'patients', 'norm', 'CASCADE', 'CASCADE');
        $this->forge->createTable('retentions');
    }

    public function down()
    {
        $this->forge->dropTable('retentions');
    }
}
