<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\SettingModel;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $settingModel = new SettingModel();

        $defaults = [
            'hero_badge'     => 'PESONA PULAU BANGKA',
            'hero_title'     => 'Temukan Pesona Keindahan Pantai Matras & Sekitarnya',
            'hero_subtitle'  => 'Nikmati jernihnya air laut, formasi batuan granit eksotis, dan ketenangan pesisir pantai. Perjalanan liburan tak terlupakan Anda dimulai dari sini.',
            'hero_btn1_text' => 'Jelajahi Pantai',
            'hero_btn1_url'  => '#destinations',
            'hero_btn2_text' => 'Lihat Peta',
            'hero_btn2_url'  => '#map',
            'hero_bg_image'  => 'assets/images/destinations/matras.jpg',
            'contact_email'  => 'info@wisatamatras.com',
            'contact_phone'  => '+62 812-3456-7890',
            'contact_address'=> 'Jalan Pantai Matras, Sinar Baru, Sungailiat, Bangka'
        ];

        foreach ($defaults as $key => $val) {
            $settingModel->setSetting($key, $val);
        }

        // Also ensure admin account exists in users table
        $db = \Config\Database::connect();
        $userBuilder = $db->table('users');
        $existingAdmin = $userBuilder->where('email', 'admin@wisatamatras.com')->get()->getRowArray();
        if (!$existingAdmin) {
            $userBuilder->insert([
                'name'       => 'Administrator Wisata',
                'email'      => 'admin@wisatamatras.com',
                'password'   => password_hash('admin123', PASSWORD_BCRYPT),
                'role'       => 'admin',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
