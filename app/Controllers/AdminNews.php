<?php

namespace App\Controllers;

use App\Models\NewsModel;
use App\Models\NewsImageModel;

class AdminNews extends BaseController
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
        $data = [
            'active_tab' => 'news',
            'title' => 'Manajemen Berita',
            'news' => $this->newsModel->orderBy('created_at', 'DESC')->findAll(),
        ];

        return view('admin/news/index', $data);
    }

    public function create()
    {
        $data = [
            'active_tab' => 'news',
            'title' => 'Tambah Berita Baru',
        ];

        return view('admin/news/create', $data);
    }

    public function save()
    {
        // Validation
        if (!$this->validate([
            'title' => 'required',
            'content' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal. Pastikan semua field diisi.');
        }

        $title = $this->request->getPost('title');
        $slug = url_title($title, '-', true);

        // Check if slug exists
        $count = $this->newsModel->where('slug', $slug)->countAllResults();
        if ($count > 0) {
            $slug = $slug . '-' . time();
        }

        $newsId = $this->newsModel->insert([
            'title' => $title,
            'slug' => $slug,
            'content' => $this->request->getPost('content')
        ]);

        // Handle Images
        if ($imagefile = $this->request->getFiles()) {
            $isFirst = true;
            foreach ($imagefile['images'] as $img) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $newName = $img->getRandomName();
                    $img->move('assets/images/news', $newName);
                    
                    $this->newsImageModel->insert([
                        'news_id' => $newsId,
                        'image_path' => 'assets/images/news/' . $newName,
                        'is_main' => $isFirst ? 1 : 0
                    ]);
                    $isFirst = false;
                }
            }
        }

        return redirect()->to('/admin/news')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $news = $this->newsModel->find($id);
        if (!$news) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'active_tab' => 'news',
            'title' => 'Edit Berita',
            'news' => $news,
            'images' => $this->newsImageModel->getImagesByNewsId($id),
        ];

        return view('admin/news/edit', $data);
    }

    public function update($id)
    {
        // Validation
        if (!$this->validate([
            'title' => 'required',
            'content' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal. Pastikan semua field diisi.');
        }

        $title = $this->request->getPost('title');
        $slug = url_title($title, '-', true);

        // Check if slug exists (exclude current)
        $existing = $this->newsModel->where('slug', $slug)->where('id !=', $id)->first();
        if ($existing) {
            $slug = $slug . '-' . time();
        }

        $this->newsModel->update($id, [
            'title' => $title,
            'slug' => $slug,
            'content' => $this->request->getPost('content')
        ]);

        // Handle Additional Images
        if ($imagefile = $this->request->getFiles()) {
            foreach ($imagefile['images'] as $img) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $newName = $img->getRandomName();
                    $img->move('assets/images/news', $newName);
                    
                    // check if there is any main image for this news
                    $hasMain = $this->newsImageModel->getMainImage($id);

                    $this->newsImageModel->insert([
                        'news_id' => $id,
                        'image_path' => 'assets/images/news/' . $newName,
                        'is_main' => $hasMain ? 0 : 1
                    ]);
                }
            }
        }

        return redirect()->to('/admin/news')->with('success', 'Berita berhasil diperbarui.');
    }

    public function setMainImage($newsId, $imageId)
    {
        $this->newsImageModel->setMainImage($newsId, $imageId);
        return redirect()->back()->with('success', 'Foto utama berhasil diubah.');
    }

    public function deleteImage($id)
    {
        $image = $this->newsImageModel->find($id);
        if ($image) {
            $filePath = FCPATH . ltrim($image['image_path'], '/\\');
            if (file_exists($filePath) && is_file($filePath)) {
                unlink($filePath);
            }
            $this->newsImageModel->delete($id);
            
            // If it was main image, set another one as main if exists
            if ($image['is_main'] == 1) {
                $otherImage = $this->newsImageModel->where('news_id', $image['news_id'])->first();
                if ($otherImage) {
                    $this->newsImageModel->update($otherImage['id'], ['is_main' => 1]);
                }
            }
            
            return redirect()->back()->with('success', 'Foto berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'Foto tidak ditemukan.');
    }

    public function delete($id)
    {
        $images = $this->newsImageModel->where('news_id', $id)->findAll();
        foreach ($images as $img) {
            $filePath = FCPATH . ltrim($img['image_path'], '/\\');
            if (file_exists($filePath) && is_file($filePath)) {
                unlink($filePath);
            }
        }
        $this->newsModel->delete($id);
        return redirect()->to('/admin/news')->with('success', 'Berita berhasil dihapus.');
    }
}
