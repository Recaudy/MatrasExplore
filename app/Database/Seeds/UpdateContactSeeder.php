<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UpdateContactSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        
        // 1. Rename email to phone in contact_messages
        $fields = [
            'email' => [
                'name' => 'phone',
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true
            ]
        ];
        $forge = \Config\Database::forge();
        
        // Check if email column exists to avoid errors on reruns
        if ($db->fieldExists('email', 'contact_messages')) {
            $forge->modifyColumn('contact_messages', $fields);
        }

        // 2. Add 'contact_hours' to settings
        $db->table('settings')->ignore(true)->insert([
            'setting_key' => 'contact_hours',
            'setting_value' => 'Setiap Hari • 08:00 — 17:00 WIB'
        ]);
        
        // Let's also ensure contact_email, phone, and address are set to the requested default values if they don't exist
        $db->table('settings')->where('setting_key', 'contact_email')->update(['setting_value' => 'hello@explorebangka.id']);
        $db->table('settings')->where('setting_key', 'contact_phone')->update(['setting_value' => '+62 717 123 456']);
        $db->table('settings')->where('setting_key', 'contact_address')->update(['setting_value' => 'Jl. Pantai Matras, Sungailiat, Bangka']);
    }
}
