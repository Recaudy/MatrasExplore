<?php

namespace App\Controllers;

use App\Models\DestinationModel;
use App\Models\ReviewModel;
use App\Models\DestinationUserGalleryModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Destination extends BaseController
{
    public function index()
    {
        return redirect()->to(base_url('#destinations'));
    }

    public function detail(string $slug): string
    {
        $destModel = new DestinationModel();
        
        $destination = $destModel->where('slug', $slug)->first();

        if (!$destination) {
            throw PageNotFoundException::forPageNotFound("Beach destination not found: " . esc($slug));
        }

        // Fetch related images, facilities, and accommodations
        $images = $destModel->getImages($destination['id']);
        $facilities = $destModel->getFacilities($destination['id']);
        $accommodations = $destModel->getAccommodations($destination['id']);

        // Fetch user reviews and statistical breakdown
        $reviewModel = new ReviewModel();
        $reviews = $reviewModel->getReviewsByDestination($destination['id']);
        $ratingStats = $reviewModel->getDestinationRatingStats($destination['id']);

        // Fetch user contributed gallery photos
        $userGalleryModel = new DestinationUserGalleryModel();
        $userPhotos = $userGalleryModel->getPhotosByDestination($destination['id']);

        $data = [
            'title' => $destination['name'] . ' - Desa Wisata Matras',
            'meta_description' => esc($destination['description']),
            'destination' => $destination,
            'images' => $images,
            'facilities' => $facilities,
            'accommodations' => $accommodations,
            'reviews' => $reviews,
            'ratingStats' => $ratingStats,
            'userPhotos' => $userPhotos,
            'pageStyles' => ['destination.css', 'review.css', 'user-gallery.css', 'gallery.css'],
            'pageScripts' => ['gallery.js', 'review-modal.js', 'gallery-modal.js']
        ];

        return view('destination/detail', $data);
    }

    public function addGalleryPhoto()
    {
        $userGalleryModel = new DestinationUserGalleryModel();
        
        $destinationId = (int) $this->request->getPost('destination_id');
        $slug = $this->request->getPost('slug');
        
        // Validation rules
        $rules = [
            'name'        => [
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'Nama lengkap wajib diisi.',
                    'min_length' => 'Nama lengkap minimal 3 karakter.',
                    'max_length' => 'Nama lengkap maksimal 100 karakter.'
                ]
            ],
            'phone'       => [
                'rules' => 'required|numeric|min_length[10]|max_length[15]',
                'errors' => [
                    'required' => 'Nomor HP wajib diisi.',
                    'numeric' => 'Nomor HP hanya boleh berisi angka.',
                    'min_length' => 'Nomor HP minimal 10 angka.',
                    'max_length' => 'Nomor HP maksimal 15 angka.'
                ]
            ],
            'title'       => [
                'rules' => 'required|min_length[3]|max_length[150]',
                'errors' => [
                    'required' => 'Judul foto wajib diisi.',
                    'min_length' => 'Judul foto minimal 3 karakter.',
                    'max_length' => 'Judul foto maksimal 150 karakter.'
                ]
            ],
            'description' => [
                'rules' => 'required|min_length[10]|max_length[1000]',
                'errors' => [
                    'required' => 'Deskripsi wajib diisi.',
                    'min_length' => 'Deskripsi minimal 10 karakter.',
                    'max_length' => 'Deskripsi maksimal 1000 karakter.'
                ]
            ],
            'image'       => [
                'rules' => 'uploaded[image]|is_image[image]|max_size[image,10240]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]',
                'errors' => [
                    'uploaded' => 'File gambar wajib diupload.',
                    'is_image' => 'File harus berupa gambar.',
                    'max_size' => 'Ukuran gambar maksimal 10MB.',
                    'mime_in' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            // Return JSON for AJAX, otherwise redirect back with error
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['status' => 'error', 'errors' => $this->validator->getErrors()]);
            }
            return redirect()->back()->withInput()->with('gallery_error', 'Gagal mengupload! Pastikan semua kolom terisi, format gambar benar (JPG/PNG), dan ukuran maksimal 10MB.');
        }

        $imageFile = $this->request->getFile('image');
        $imagePath = '';

        if ($imageFile->isValid() && !$imageFile->hasMoved()) {
            $uploadDir = FCPATH . 'uploads/destination_gallery';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $newName = $imageFile->getRandomName();
            $imageFile->move($uploadDir, $newName);
            $imagePath = 'uploads/destination_gallery/' . $newName;
        } else {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'File processing failed: ' . $imageFile->getErrorString()]);
            }
            return redirect()->back()->withInput()->with('gallery_error', 'Gagal memproses file gambar: ' . $imageFile->getErrorString());
        }

        $data = [
            'destination_id' => $destinationId,
            'name'           => esc($this->request->getPost('name')),
            'phone'          => esc($this->request->getPost('phone')),
            'title'          => esc($this->request->getPost('title')),
            'description'    => esc($this->request->getPost('description')),
            'image_path'     => $imagePath,
            'status'         => 'pending',
            'created_at'     => date('Y-m-d H:i:s')
        ];

        $userGalleryModel->insert($data);

        // If AJAX request, respond with JSON instead of redirect
        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Foto/Gambar Anda berhasil dikirim! Status saat ini: Menunggu Persetujuan Admin sebelum ditampilkan.'
            ]);
        }

        if ($slug === 'home' || empty($slug)) {
            return redirect()->back()->with('gallery_success', 'Foto/Gambar Anda berhasil dikirim! Status saat ini: Menunggu Persetujuan Admin sebelum ditampilkan.');
        }

        return redirect()->to(base_url('destinations/' . $slug . '#user-gallery-section'))->with('gallery_success', 'Foto/Gambar Anda berhasil dikirim! Status saat ini: Menunggu Persetujuan Admin sebelum ditampilkan.');
    }

    public function addReview()
    {
        $reviewModel = new ReviewModel();
        
        $destinationId = (int) $this->request->getPost('destination_id');
        $slug = $this->request->getPost('slug');
        
        // Validation rules
        $rules = [
            'name' => [
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'Nama lengkap wajib diisi.',
                    'min_length' => 'Nama lengkap minimal 3 karakter.',
                    'max_length' => 'Nama lengkap maksimal 100 karakter.'
                ]
            ],
            'phone' => [
                'rules' => 'required|numeric|min_length[10]|max_length[15]',
                'errors' => [
                    'required' => 'Nomor HP wajib diisi.',
                    'numeric' => 'Nomor HP hanya boleh berisi angka.',
                    'min_length' => 'Nomor HP minimal 10 angka.',
                    'max_length' => 'Nomor HP maksimal 15 angka.'
                ]
            ],
            'rating' => [
                'rules' => 'required|in_list[1,2,3,4,5]',
                'errors' => [
                    'required' => 'Rating bintang wajib dipilih.',
                    'in_list' => 'Rating bintang tidak valid.'
                ]
            ],
            'comment' => [
                'rules' => 'required|min_length[10]|max_length[2000]',
                'errors' => [
                    'required' => 'Isi ulasan wajib diisi.',
                    'min_length' => 'Isi ulasan minimal 10 karakter.',
                    'max_length' => 'Isi ulasan maksimal 2000 karakter.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['status' => 'error', 'errors' => $this->validator->getErrors()]);
            }
            return redirect()->back()->withInput()->with('error', 'Silakan periksa kembali isian form Anda.');
        }

        $data = [
            'destination_id' => $destinationId,
            'name'           => esc($this->request->getPost('name')),
            'phone'          => esc($this->request->getPost('phone')),
            'rating'         => (int) $this->request->getPost('rating'),
            'comment'        => esc($this->request->getPost('comment')),
            'status'         => 'pending',
            'created_at'     => date('Y-m-d H:i:s')
        ];

        $reviewModel->insert($data);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Review & rating Anda berhasil dikirim! Status saat ini: Menunggu Persetujuan Admin.'
            ]);
        }

        return redirect()->to(base_url('destinations/' . $slug . '#reviews-section'))->with('success', 'Review & rating Anda berhasil dikirim! Status saat ini: Menunggu Persetujuan Admin.');
    }
}
