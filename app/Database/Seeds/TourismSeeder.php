<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TourismSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // Disable foreign keys during seeding
        $db->query('SET FOREIGN_KEY_CHECKS = 0');

        // 1. Seed Users
        $db->table('users')->truncate();
        $db->table('users')->insert([
            'name'       => 'Admin Explore Bangka',
            'email'      => 'admin@explorebangka.com',
            'password'   => password_hash('admin123', PASSWORD_DEFAULT),
            'role'       => 'admin',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // 2. Seed Facilities
        $db->table('facilities')->truncate();
        $facilities = [
            ['id' => 1, 'name' => 'Free Wi-Fi', 'icon' => 'wifi'],
            ['id' => 2, 'name' => 'Free Parking', 'icon' => 'parking'],
            ['id' => 3, 'name' => 'Coffee Shop', 'icon' => 'coffee'],
            ['id' => 4, 'name' => 'Restaurant', 'icon' => 'restaurant'],
            ['id' => 5, 'name' => 'Swimming Pool', 'icon' => 'pool'],
            ['id' => 6, 'name' => 'Air Conditioning', 'icon' => 'ac'],
            ['id' => 7, 'name' => 'Perahu Kayak', 'icon' => 'kayaking'],
            ['id' => 8, 'name' => 'Snorkeling', 'icon' => 'waves'],
            ['id' => 9, 'name' => 'Toilet / WC', 'icon' => 'wc'],
            ['id' => 10, 'name' => 'Mushola', 'icon' => 'mosque'],
            ['id' => 11, 'name' => 'Pusat UMKM', 'icon' => 'storefront'],
            ['id' => 12, 'name' => 'Sewa ATV', 'icon' => 'directions_car'],
            ['id' => 13, 'name' => 'Pondok / Gazebo', 'icon' => 'cottage'],
        ];
        $db->table('facilities')->insertBatch($facilities);

        // 3. Seed Destinations
        $db->table('destinations')->truncate();
        $destinations = [
            [
                'id'            => 1,
                'name'          => 'Pantai Matras',
                'slug'          => 'pantai-matras',
                'description'   => 'A long, sun-washed shoreline where clear blue water, family moments, and island mornings meet.',
                'history'       => 'Pantai Matras is one of the most popular and historical beaches in Bangka. Often referred to as the "People\'s Beach", it features soft white sand extending for several kilometers, framed by coconut groves. For decades, it has served as a central hub for local family gatherings, picnics, and beach soccer, while also supporting local fish markets and coastal community life.',
                'location'      => 'Sungailiat, Bangka',
                'latitude'      => -1.82136000,
                'longitude'     => 106.14371000,
                'opening_hours' => '24 Hours',
                'ticket_price'  => 5000.00,
                'status'        => 'active',
                'created_at'    => date('Y-m-d H:i:s')
            ],
            [
                'id'            => 2,
                'name'          => 'Pantai Jambosag',
                'slug'          => 'pantai-jambosag',
                'description'   => 'A quieter pocket of coast for slow days, calm waves, local fishing boats, and unhurried sea air.',
                'history'       => 'Pantai Jambosag is a serene and peaceful coastal destination located in northern Bangka near Belinyu. Unlike more touristy shores, Jambosag offers a calm escape with gentle waves, local wooden fishing boats anchoring along the shallow waters, and traditional fisherman huts. It is highly valued for its tranquil atmosphere, making it a perfect spot for meditation, reading, and enjoying fresh sea breeze without the crowds.',
                'location'      => 'Belinyu, Bangka',
                'latitude'      => -1.61208000,
                'longitude'     => 105.78912000,
                'opening_hours' => '06:00 - 18:00',
                'ticket_price'  => 10000.00,
                'status'        => 'active',
                'created_at'    => date('Y-m-d H:i:s')
            ],
            [
                'id'            => 3,
                'name'          => 'Pantai Turun Aban',
                'slug'          => 'pantai-turun-aban',
                'description'   => 'Sculptural granite rocks frame a cinematic coastline made for golden hours and wild camping stories.',
                'history'       => 'Pantai Turun Aban is a small, unique cove famous for its towering and dramatically stacked granite rocks. These ancient stone formations have been sculpted by wind and waves over millions of years. Today, Turun Aban is a favorite spot for young adventurers, campers, and landscape photographers. It offers a spectacular, unobstructed view of the sunrise, casting a golden hue over the giant boulders and deep blue sea.',
                'location'      => 'Sungailiat, Bangka',
                'latitude'      => -1.83612000,
                'longitude'     => 106.16041000,
                'opening_hours' => '07:00 - 19:00',
                'ticket_price'  => 5000.00,
                'status'        => 'active',
                'created_at'    => date('Y-m-d H:i:s')
            ],
        ];
        $db->table('destinations')->insertBatch($destinations);

        // 4. Seed Destination Images
        $db->table('destination_images')->truncate();
        $dest_images = [
            ['destination_id' => 1, 'image' => 'assets/images/destinations/matras.jpg', 'caption' => 'Scenic view of Pantai Matras shore'],
            ['destination_id' => 1, 'image' => 'assets/images/destinations/matras_2.jpg', 'caption' => 'Sunset at Pantai Matras'],
            ['destination_id' => 2, 'image' => 'assets/images/destinations/jambosag.jpg', 'caption' => 'Crystal waters of Pantai Jambosag'],
            ['destination_id' => 3, 'image' => 'assets/images/destinations/turun_aban.jpg', 'caption' => 'Granite boulders at Pantai Turun Aban'],
            ['destination_id' => 3, 'image' => 'assets/images/destinations/turun_aban_2.jpg', 'caption' => 'Camping spots at Turun Aban'],
        ];
        $db->table('destination_images')->insertBatch($dest_images);

        // 5. Seed Gallery Images
        $db->table('gallery')->truncate();
        $gallery = [
            [
                'destination_id' => 1,
                'title'          => 'Above the turquoise',
                'description'    => 'An aerial view of the sparkling turquoise waters contrasting against the white sand coastline of Bangka.',
                'image'          => 'assets/images/gallery/turquoise.jpg',
                'created_at'     => date('Y-m-d H:i:s')
            ],
            [
                'destination_id' => 1,
                'title'          => 'Matras morning',
                'description'    => 'Bright golden sunlight lighting up the calm, sweeping sands of Pantai Matras during the early hours.',
                'image'          => 'assets/images/gallery/matras_morning.jpg',
                'created_at'     => date('Y-m-d H:i:s')
            ],
            [
                'destination_id' => 2,
                'title'          => 'The quiet side',
                'description'    => 'Traditional fishing vessels floating in the calm, shallow tides of Pantai Jambosag.',
                'image'          => 'assets/images/gallery/quiet_side.jpg',
                'created_at'     => date('Y-m-d H:i:s')
            ],
            [
                'destination_id' => 3,
                'title'          => 'An island sunset',
                'description'    => 'A majestic sunset framing the distant islets and granite rocks of Pantai Turun Aban.',
                'image'          => 'assets/images/gallery/island_sunset.jpg',
                'created_at'     => date('Y-m-d H:i:s')
            ],
            [
                'destination_id' => 3,
                'title'          => 'Granite country',
                'description'    => 'Towering stacks of smooth granite boulders rising from the soft sands, a signature look of Bangka.',
                'image'          => 'assets/images/gallery/granite_country.jpg',
                'created_at'     => date('Y-m-d H:i:s')
            ],
            [
                'destination_id' => 3,
                'title'          => 'Wave watch',
                'description'    => 'Water splashing and flowing gracefully between cracks of ancient coastal boulders during golden hour.',
                'image'          => 'assets/images/gallery/wave_watch.jpg',
                'created_at'     => date('Y-m-d H:i:s')
            ],
        ];
        $db->table('gallery')->insertBatch($gallery);

        // 6. Seed Accommodations
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

        // 7. Seed Destination Facilities
        $db->table('destination_facilities')->truncate();
        $dest_facilities = [
            // Pantai Matras (1) has Wifi (1), Parking (2), Coffee (3), Restaurant (4), Pool (5), AC (6)
            ['destination_id' => 1, 'facility_id' => 1],
            ['destination_id' => 1, 'facility_id' => 2],
            ['destination_id' => 1, 'facility_id' => 3],
            ['destination_id' => 1, 'facility_id' => 4],
            ['destination_id' => 1, 'facility_id' => 5],
            ['destination_id' => 1, 'facility_id' => 6],

            // Pantai Jambosag (2) has Wifi (1), Parking (2), Coffee (3)
            ['destination_id' => 2, 'facility_id' => 1],
            ['destination_id' => 2, 'facility_id' => 2],
            ['destination_id' => 2, 'facility_id' => 3],

            // Pantai Turun Aban (3) has Wifi (1), Parking (2), Coffee (3), Restaurant (4)
            ['destination_id' => 3, 'facility_id' => 1],
            ['destination_id' => 3, 'facility_id' => 2],
            ['destination_id' => 3, 'facility_id' => 3],
            ['destination_id' => 3, 'facility_id' => 4],
        ];
        $db->table('destination_facilities')->insertBatch($dest_facilities);

        // Re-enable foreign keys
        $db->query('SET FOREIGN_KEY_CHECKS = 1');
    }
}
