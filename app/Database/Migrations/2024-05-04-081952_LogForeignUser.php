<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LogForeignUser extends Migration
{
    public function up()
    {
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropForeignKey('logs', 'logs_user_id_foreign');
    }
}
