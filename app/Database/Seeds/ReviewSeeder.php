<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $reviews = [
            // Pantai Matras (ID 1) - 4 Reviews
            [
                'destination_id' => 1,
                'name'           => 'Rizky Pratama',
                'phone'          => '081234567890',
                'rating'         => 5,
                'comment'        => 'Pantai Matras luar biasa indah! Pasir putihnya sangat halus dan panjang, cocok banget untuk liburan santai bareng keluarga besar.',
                'status'         => 'pending',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-5 days'))
            ],
            [
                'destination_id' => 1,
                'name'           => 'Dinda Putri Ayu',
                'phone'          => '081398765432',
                'rating'         => 5,
                'comment'        => 'Suasana sore di sini tenang banget, deburan ombaknya bikin rileks setelah sepekan kerja. Sangat recommended!',
                'status'         => 'pending',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-3 days'))
            ],
            [
                'destination_id' => 1,
                'name'           => 'Budi Santoso',
                'phone'          => '085711223344',
                'rating'         => 4,
                'comment'        => 'Akses jalan menuju pantai sudah sangat mulus dan dekat dari pusat kota Sungailiat.',
                'status'         => 'pending',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-1 day'))
            ],
            [
                'destination_id' => 1,
                'name'           => 'Ahmad Fauzi',
                'phone'          => '081255667788',
                'rating'         => 5,
                'comment'        => 'Tempat wisata keluarga terbaik di Bangka. Fasilitas lengkap dan banyak warung makanan enak.',
                'status'         => 'pending',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-2 hours'))
            ],

            // Pantai Jambosag (ID 2) - 3 Reviews
            [
                'destination_id' => 2,
                'name'           => 'Hendra Wijaya',
                'phone'          => '081988776655',
                'rating'         => 5,
                'comment'        => 'Surga tersembunyi di Bangka! Pantai Jambosag sangat tenang, alami, dan jauh dari keramaian.',
                'status'         => 'pending',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-6 days'))
            ],
            [
                'destination_id' => 2,
                'name'           => 'Siti Nurhaliza',
                'phone'          => '082133445566',
                'rating'         => 5,
                'comment'        => 'Tempat terbaik untuk healing dan meditasi. Ombak yang tenang bikin betah berlama-lama.',
                'status'         => 'pending',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-2 days'))
            ],
            [
                'destination_id' => 2,
                'name'           => 'Wahyu Hidayat',
                'phone'          => '085344556677',
                'rating'         => 4,
                'comment'        => 'Pemandangan kapal nelayan yang menepi sangat estetik. Spot foto yang unik dan berbeda.',
                'status'         => 'pending',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-10 hours'))
            ],

            // Pantai Turun Aban (ID 3) - 3 Reviews
            [
                'destination_id' => 3,
                'name'           => 'Arif Kurniawan',
                'phone'          => '087855667788',
                'rating'         => 5,
                'comment'        => 'Formasi batu granit raksasa di Pantai Turun Aban sangat ikonik dan dramatis!',
                'status'         => 'pending',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-4 days'))
            ],
            [
                'destination_id' => 3,
                'name'           => 'Melani Anggraini',
                'phone'          => '085299887766',
                'rating'         => 5,
                'comment'        => 'Teluk kecil dengan air yang super jernih bak kristal. Sangat cocok untuk camping.',
                'status'         => 'pending',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-2 days'))
            ],
            [
                'destination_id' => 3,
                'name'           => 'Reza Rahadian',
                'phone'          => '081377889900',
                'rating'         => 5,
                'comment'        => 'Sunrise di sini juaranya! Batuan granit raksasa menambah kesan eksotis yang luar biasa.',
                'status'         => 'pending',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-5 hours'))
            ]
        ];

        $this->db->table('reviews')->truncate();
        $this->db->table('reviews')->insertBatch($reviews);
    }
}
