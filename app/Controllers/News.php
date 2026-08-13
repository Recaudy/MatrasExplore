<?php

namespace App\Controllers;

use App\Models\NewsModel;
use App\Models\NewsImageModel;

class News extends BaseController
{
    protected $newsModel;
    protected $newsImageModel;

    public function __construct()
    {
        $this->newsModel = new NewsModel();
        $this->newsImageModel = new NewsImageModel();
    }

    public function index()
    {
        // Get all news and their main image
        $newsList = $this->newsModel->orderBy('created_at', 'DESC')->findAll();
        foreach ($newsList as &$n) {
            $mainImg = $this->newsImageModel->getMainImage($n['id']);
            $n['image'] = $mainImg ? $mainImg['image_path'] : 'assets/images/placeholder.jpg';
        }

        $data = [
            'title' => 'Berita & Artikel - Desa Wisata Matras',
            'meta_description' => 'Kumpulan berita dan artikel terbaru seputar kawasan Pantai Matras.',
            'news' => $newsList,
            'pageStyles' => ['news.css']
        ];

        return view('news/index', $data);
    }

    public function detail($slug)
    {
        $newsItem = $this->newsModel->where('slug', $slug)->first();

        if (!$newsItem) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $images = $this->newsImageModel->getImagesByNewsId($newsItem['id']);

        $data = [
            'title' => $newsItem['title'] . ' - Desa Wisata Matras',
            'meta_description' => substr(strip_tags($newsItem['content']), 0, 150) . '...',
            'news' => $newsItem,
            'images' => $images,
            'pageStyles' => ['news.css'],
            'pageScripts' => [] // Will add swiper.js via CDN in the view directly
        ];

        return view('news/detail', $data);
    }
}
