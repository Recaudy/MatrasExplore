<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class VisitorSeeder extends Seeder
{
    public function run()
    {
        $data = [];

        // Generate web visitor data for the past 30 days
        for ($i = 30; $i >= 0; $i--) {
            $date = Time::now()->subDays($i);
            
            // Random number of distinct visitors per day
            $dailyVisitors = rand(10, 50);
            
            for ($j = 0; $j < $dailyVisitors; $j++) {
                // Generate a random IP address
                $ipAddress = rand(1, 255) . '.' . rand(0, 255) . '.' . rand(0, 255) . '.' . rand(1, 255);
                
                $data[] = [
                    'ip_address' => $ipAddress,
                    'visit_date' => $date->format('Y-m-d'),
                    'created_at' => $date->format('Y-m-d H:i:s'),
                    'updated_at' => $date->format('Y-m-d H:i:s'),
                ];
            }
        }

        // Using Query Builder
        $this->db->table('visitors')->truncate();
        
        // Insert in chunks to avoid memory/packet size issues if there are too many records
        $chunks = array_chunk($data, 200);
        foreach ($chunks as $chunk) {
            $this->db->table('visitors')->insertBatch($chunk);
        }
    }
}
