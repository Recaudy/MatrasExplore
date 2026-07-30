<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DestinationUserGallerySeeder extends Seeder
{
    public function run()
    {
        $photos = [
            // Pantai Matras (ID 1) - 4 Photos
            [
                'destination_id' => 1,
                'name'           => 'Fajar Setiawan',
                'phone'          => '081234112233',
                'title'          => 'Pagi Tenang di Pasir Putih Matras',
                'description'    => 'Suasana matahari terbit yang begitu lembut.',
                'image_path'     => 'assets/images/gallery/matras_morning.jpg',
                'status'         => 'pending',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-4 days'))
            ],
            [
                'destination_id' => 1,
                'name'           => 'Larasati Putri',
                'phone'          => '081344556677',
                'title'          => 'Kilau Air Laut & Bebatuan Granit',
                'description'    => 'Menikmati deburan ombak siang hari dari sudut batu granit eksotis.',
                'image_path'     => 'assets/images/gallery/granite_country.jpg',
                'status'         => 'pending',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-2 days'))
            ],
            [
                'destination_id' => 1,
                'name'           => 'Andi Darmawan',
                'phone'          => '085733221144',
                'title'          => 'Bermain Pasir Bersama Anak',
                'description'    => 'Pantai yang ramah untuk keluarga dan anak-anak.',
                'image_path'     => 'assets/images/gallery/wave_watch.jpg',
                'status'         => 'pending',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-1 day'))
            ],
            [
                'destination_id' => 1,
                'name'           => 'Tika Mustika',
                'phone'          => '081299887766',
                'title'          => 'Gradasi Warna Air Laut',
                'description'    => 'Air laut yang jernih dengan gradasi biru yang memukau.',
                'image_path'     => 'assets/images/gallery/turquoise.jpg',
                'status'         => 'pending',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-5 hours'))
            ],

            // Pantai Jambosag (ID 2) - 3 Photos
            [
                'destination_id' => 2,
                'name'           => 'Bagus Permana',
                'phone'          => '081999887766',
                'title'          => 'Keheningan Pantai Jambosag',
                'description'    => 'Tempat terbaik untuk menyepi dari bisingnya perkotaan.',
                'image_path'     => 'assets/images/gallery/quiet_side.jpg',
                'status'         => 'pending',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-5 days'))
            ],
            [
                'destination_id' => 2,
                'name'           => 'Siska Amelia',
                'phone'          => '085711229988',
                'title'          => 'Senja Biru Turqouise',
                'description'    => 'Warna gradasi air laut yang memukau saat sore menjelang hoàng hôn.',
                'image_path'     => 'assets/images/gallery/turquoise.jpg',
                'status'         => 'pending',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-1 day'))
            ],
            [
                'destination_id' => 2,
                'name'           => 'Robby Pratama',
                'phone'          => '081233445566',
                'title'          => 'Perahu Nelayan Bersandar',
                'description'    => 'Pemandangan klasik perahu kayu nelayan lokal di sore hari.',
                'image_path'     => 'assets/images/gallery/quiet_side.jpg',
                'status'         => 'pending',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-12 hours'))
            ],

            // Pantai Turun Aban (ID 3) - 3 Photos
            [
                'destination_id' => 3,
                'name'           => 'Rangga Saputra',
                'phone'          => '082155667788',
                'title'          => 'Formasi Granit Megah Turun Aban',
                'description'    => 'Bebatuan granit raksasa yang menjadi ciri khas utama pantai ini.',
                'image_path'     => 'assets/images/destinations/turun_aban_2.jpg',
                'status'         => 'pending',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-3 days'))
            ],
            [
                'destination_id' => 3,
                'name'           => 'Nabila Syakirah',
                'phone'          => '087811223344',
                'title'          => 'Sunset Eksotis di Balik Batu',
                'description'    => 'Menunggu siluet matahari terbenam dari selah tebing batu granit Turun Aban.',
                'image_path'     => 'assets/images/gallery/island_sunset.jpg',
                'status'         => 'pending',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-1 day'))
            ],
            [
                'destination_id' => 3,
                'name'           => 'Kevin Wijaya',
                'phone'          => '085288776655',
                'title'          => 'Camping Ceria',
                'description'    => 'Momen camping tak terlupakan bersama teman-teman.',
                'image_path'     => 'assets/images/destinations/turun_aban_2.jpg',
                'status'         => 'pending',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-3 hours'))
            ]
        ];

        $this->db->table('destination_user_galleries')->truncate();
        $this->db->table('destination_user_galleries')->insertBatch($photos);
    }
}
