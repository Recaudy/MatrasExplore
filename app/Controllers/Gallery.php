<?php

namespace App\Controllers;


use App\Models\DestinationModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Gallery extends BaseController
{
    public function index(): string
    {
        $userGalleryModel = new \App\Models\DestinationUserGalleryModel();
        $allGallery = [];

        $userPhotos = $userGalleryModel->where('status', 'approved')->orderBy('id', 'DESC')->findAll();
        foreach ($userPhotos as $photo) {
            $allGallery[] = [
                'id'          => 'user_' . $photo['id'],
                'title'       => $photo['title'],
                'description' => $photo['description'] . ' (Foto kiriman dari ' . $photo['name'] . ')',
                'image'       => $photo['image_path'],
                'type'        => 'user',
                'author'      => $photo['name']
            ];
        }

        $officialGalleryModel = new \App\Models\GalleryModel();
        $officialPhotos = $officialGalleryModel->orderBy('id', 'DESC')->findAll();
        foreach ($officialPhotos as $photo) {
            $allGallery[] = [
                'id'          => 'official_' . $photo['id'],
                'title'       => $photo['title'],
                'description' => $photo['description'],
                'image'       => $photo['image'],
                'type'        => 'official',
                'author'      => 'Admin'
            ];
        }

        $destModel = new DestinationModel();
        $destinations = $destModel->where('status', 'active')->findAll();

        $data = [
            'title' => 'Galeri & Jurnal Visual - Explore Bangka Beaches',
            'meta_description' => 'Kumpulan potret keindahan pesisir pantai Bangka, laut jernih, pasir putih, serta foto kontribusi dari para pengunjung setia.',
            'gallery' => $allGallery,
            'destinations' => $destinations,
            'pageStyles' => ['gallery.css'],
            'pageScripts' => ['gallery.js']
        ];

        return view('gallery/index', $data);
    }

    public function detail(int $id): string
    {
        $galleryModel = new GalleryModel();
        $destModel = new DestinationModel();

        $item = $galleryModel->find($id);

        if (!$item) {
            throw PageNotFoundException::forPageNotFound("Gallery item not found: " . esc($id));
        }

        // Fetch destination details if linked
        if (!empty($item['destination_id'])) {
            $dest = $destModel->find($item['destination_id']);
            $item['destination_slug'] = $dest ? $dest['slug'] : null;
        } else {
            $item['destination_slug'] = null;
        }

        $data = [
            'title' => $item['title'] . ' - Explore Bangka Beaches',
            'meta_description' => esc($item['description']),
            'item' => $item,
            'pageStyles' => ['gallery.css']
        ];

        return view('gallery/detail', $data);
    }
}
