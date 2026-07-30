<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEntranceLogsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'amount'      => ['type' => 'INT', 'constraint' => 11],
            'total_after' => ['type' => 'INT', 'constraint' => 11],
            'admin_name'  => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('entrance_logs');
    }

    public function down()
    {
        $this->forge->dropTable('entrance_logs');
    }
}
