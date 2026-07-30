<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\GalleryModel;

class GallerySeeder extends Seeder
{
    public function run()
    {
        $galleryModel = new GalleryModel();
        $data = [];
        // Generate 10 dummy gallery items
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'destination_id' => null, // no specific destination
                'title' => "Foto Galeri {$i}",
                'description' => "Deskripsi singkat untuk foto galeri ke-{$i}.",
                'image' => "assets/images/gallery/gallery{$i}.jpg",
                'created_at' => date('Y-m-d H:i:s'),
                'show_on_dashboard' => 0,
            ];
        }
        // Insert batch of 10 records
        $galleryModel->insertBatch($data);
    }
}
?>
