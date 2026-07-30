<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddShowOnDashboardToGallery extends Migration
{
    public function up()
    {
                // Add 'show_on_dashboard' column to gallery table
        $fields = [
            'show_on_dashboard' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'null' => false,
                'after' => 'created_at',
            ],
        ];
        $this->forge->addColumn('gallery', $fields);
    }

    public function down()
    {
        // Drop 'show_on_dashboard' column from gallery table
        $this->forge->dropColumn('gallery', 'show_on_dashboard');
    }
}
