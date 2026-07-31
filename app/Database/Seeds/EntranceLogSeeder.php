<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class EntranceLogSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        $totalAfter = 0;
        $adminName = 'Admin Matras';

        // Generate data for the past 30 days
        for ($i = 30; $i >= 0; $i--) {
            $date = Time::now()->subDays($i);
            
            // Random amount between 50 and 500, higher on weekends
            $isWeekend = in_array($date->format('N'), [6, 7]);
            $amount = $isWeekend ? rand(300, 800) : rand(50, 200);
            
            $totalAfter += $amount;

            $data[] = [
                'amount'      => $amount,
                'total_after' => $totalAfter,
                'admin_name'  => $adminName,
                'created_at'  => $date->format('Y-m-d 08:00:00'),
                'updated_at'  => $date->format('Y-m-d 08:00:00'),
            ];
            
            // Maybe a second entry on the same day for afternoon shift
            $amount2 = $isWeekend ? rand(200, 600) : rand(30, 150);
            $totalAfter += $amount2;
            
            $data[] = [
                'amount'      => $amount2,
                'total_after' => $totalAfter,
                'admin_name'  => $adminName,
                'created_at'  => $date->format('Y-m-d 14:00:00'),
                'updated_at'  => $date->format('Y-m-d 14:00:00'),
            ];
        }

        // Using Query Builder
        $this->db->table('entrance_logs')->truncate();
        $this->db->table('entrance_logs')->insertBatch($data);
    }
}
