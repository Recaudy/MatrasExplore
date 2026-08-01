<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class ShortsSeeder extends Seeder
{
    public function run()
    {
        // Truncate the table
        $this->db->table('shorts')->truncate();
    }
}
