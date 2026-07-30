<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FacilitiesSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        
        $facilities = [
            ['id' => 7, 'name' => 'Perahu Kayak', 'icon' => 'kayaking'],
            ['id' => 8, 'name' => 'Snorkeling', 'icon' => 'waves'],
            ['id' => 9, 'name' => 'Toilet / WC', 'icon' => 'wc'],
            ['id' => 10, 'name' => 'Mushola', 'icon' => 'mosque'],
            ['id' => 11, 'name' => 'Pusat UMKM', 'icon' => 'storefront'],
            ['id' => 12, 'name' => 'Sewa ATV', 'icon' => 'directions_car'],
        ];

        // Insert ignoring duplicates if id already exists
        $db->table('facilities')->ignore(true)->insertBatch($facilities);
    }
}
