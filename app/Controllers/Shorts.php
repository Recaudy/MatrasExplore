<?php

namespace App\Controllers;

class Shorts extends BaseController
{
    public function index(): string
    {
        $shortModel = new \App\Models\ShortModel();
        
        $data = [
            'title' => 'Video Shorts - Desa Wisata Matras',
            'meta_description' => 'Tonton berbagai video pendek menarik seputar wisata Pantai Matras, Jambosag, dan Turun Aban.',
            'shorts' => $shortModel->orderBy('id', 'DESC')->findAll(),
            'pageStyles' => ['shorts.css']
        ];

        return view('shorts/index', $data);
    }
}
