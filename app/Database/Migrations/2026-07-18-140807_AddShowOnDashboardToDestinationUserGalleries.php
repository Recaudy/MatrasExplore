<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddShowOnDashboardToDestinationUserGalleries extends Migration
{
    public function up()
    {
                // Add 'show_on_dashboard' column to destination_user_galleries table
        $fields = [
            'show_on_dashboard' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'null' => false,
                'after' => 'updated_at',
            ],
        ];
        $this->forge->addColumn('destination_user_galleries', $fields);
    }

    public function down()
    {
        // Drop 'show_on_dashboard' column from destination_user_galleries table
        $this->forge->dropColumn('destination_user_galleries', 'show_on_dashboard');
    }
}
