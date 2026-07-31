<?php
// We can just use CodeIgniter's index.php to run a specific seeder, 
// but creating a standalone seeder is easier.
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AccommodationsSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        
        $db->table('accommodations')->truncate();
        $accommodations = [
            [
                'destination_id' => 1,
                'name'           => 'Hotel Santika Bangka',
                'description'    => 'Enjoy a comfortable stay at Hotel Santika Bangka, situated just a short drive from Pantai Matras. Perfect for both business and leisure travelers, the hotel offers modern amenities, a relaxing outdoor pool, an all-day dining restaurant, and highly attentive local hospitality.',
                'address'        => 'Jl. Soekarno Hatta No. 1, Pangkalpinang, Bangka',
                'price'          => 850000.00,
                'phone'          => '+62 717 4256888',
                'website'        => 'https://www.mysantika.com',
                'latitude'       => -2.14652000,
                'longitude'      => 106.12643000,
                'rating'         => 4.7,
                'image'          => 'assets/images/accommodations/santika.jpg',
                'created_at'     => date('Y-m-d H:i:s')
            ],
            [
                'destination_id' => 1,
                'name'           => 'Novilla Boutique Resort',
                'description'    => 'Novilla Boutique Resort in Sungailiat provides an elegant resort experience. Surrounded by lush gardens and featuring two large outdoor swimming pools, tennis courts, a fitness center, and a luxury spa, it is the premier choice for relaxing near Pantai Matras.',
                'address'        => 'Jl. Kenanga No. 100, Sungailiat, Bangka',
                'price'          => 1200000.00,
                'phone'          => '+62 717 92535',
                'website'        => 'https://novillaboutiqueresort.com',
                'latitude'       => -1.86542000,
                'longitude'      => 106.11542000,
                'rating'         => 4.7,
                'image'          => 'assets/images/accommodations/novilla.jpg',
                'created_at'     => date('Y-m-d H:i:s')
            ],
            [
                'destination_id' => 2,
                'name'           => 'Jambosag Cottage',
                'description'    => 'Live steps away from the peaceful sea at Jambosag Cottage. Built with traditional wood materials and modern comforts, these cozy cottages provide the ultimate slow-living experience near the tranquil shores of Pantai Jambosag.',
                'address'        => 'Belinyu Beach Coast, North Bangka',
                'price'          => 420000.00,
                'phone'          => '+62 812-3456-7890',
                'website'        => 'https://jambosagcottage.com',
                'latitude'       => -1.61300000,
                'longitude'      => 105.78850000,
                'rating'         => 4.7,
                'image'          => 'assets/images/accommodations/jambosag_cottage.jpg',
                'created_at'     => date('Y-m-d H:i:s')
            ],
            [
                'destination_id' => 3,
                'name'           => 'Turun Aban Resort',
                'description'    => 'Overlooking the iconic granite rock formations, Turun Aban Resort offers charming oceanfront chalets. Rise early to watch the gorgeous sunrise over the sea directly from your private balcony, and fall asleep to the gentle sound of waves.',
                'address'        => 'Pantai Turun Aban Road, Sungailiat, Bangka',
                'price'          => 720000.00,
                'phone'          => '+62 821-9876-5432',
                'website'        => 'https://turunabanresort.com',
                'latitude'       => -1.83550000,
                'longitude'      => 106.15950000,
                'rating'         => 4.7,
                'image'          => 'assets/images/accommodations/turun_aban_resort.jpg',
                'created_at'     => date('Y-m-d H:i:s')
            ],
        ];
        $db->table('accommodations')->insertBatch($accommodations);
    }
}
