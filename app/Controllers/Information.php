<?php

namespace App\Controllers;

use App\Models\InformationModel;

class Information extends BaseController
{
    public function index(): string
    {
        $infoModel = new InformationModel();
        
        $information = $infoModel->orderBy('id', 'DESC')->findAll();

        $data = [
            'title' => 'Pusat Informasi - Desa Wisata Matras',
            'meta_description' => 'Informasi penting seputar harga sewa, fasilitas, dan panduan wisata lainnya di pantai Bangka.',
            'information' => $information,
            'pageStyles' => ['gallery.css'], // We reuse gallery css for layout
            'pageScripts' => ['gallery.js'] // We reuse gallery js for lightbox
        ];

        return view('information/index', $data);
    }
}
