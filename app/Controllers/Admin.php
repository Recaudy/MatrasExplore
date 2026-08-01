<?php

namespace App\Controllers;

use App\Models\DestinationModel;
use App\Models\DestinationUserGalleryModel;

use App\Models\ReviewModel;
use App\Models\GalleryModel;

use App\Models\SettingModel;

class Admin extends BaseController
{
    private function checkAuth()
    {
        if (!session()->get('is_admin')) {
            return false;
        }
        return true;
    }

    // ------------------------------------------------------------------------
    // 1. DASHBOARD OVERVIEW
    // ------------------------------------------------------------------------
    public function index()
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $destModel = new DestinationModel();
        $galleryModel = new DestinationUserGalleryModel();

        $reviewModel = new ReviewModel();
        $userPhotoModel = new DestinationUserGalleryModel();
        $visitorModel = new \App\Models\VisitorModel();
        $db = \Config\Database::connect();

        $stats = [
            'total_destinations' => $destModel->countAllResults(),
            'total_gallery'      => $galleryModel->countAllResults(),
            'total_contacts'     => $db->table('contact_messages')->countAllResults(),
            'pending_reviews'    => $reviewModel->where('status', 'pending')->countAllResults(),
            'pending_photos'     => $userPhotoModel->where('status', 'pending')->countAllResults(),
            'total_visitors'     => $visitorModel->countAllResults()
        ];

        // Fetch recent pending reviews and photos for quick moderation
        $pendingReviewsList = $reviewModel->where('status', 'pending')->orderBy('created_at', 'DESC')->findAll(5);
        foreach ($pendingReviewsList as &$rev) {
            $dest = $destModel->find($rev['destination_id']);
            $rev['destination_name'] = $dest ? $dest['name'] : 'Pantai Matras';
        }

        $pendingPhotosList = $userPhotoModel->where('status', 'pending')->orderBy('created_at', 'DESC')->findAll(5);
        foreach ($pendingPhotosList as &$photo) {
            $dest = $destModel->find($photo['destination_id']);
            $photo['destination_name'] = $dest ? $dest['name'] : 'Pantai Matras';
        }

        return view('admin/dashboard', [
            'active_tab'         => 'dashboard',
            'stats'              => $stats,
            'pending_reviews'    => $pendingReviewsList,
            'pending_photos'     => $pendingPhotosList
        ]);
    }

    // ------------------------------------------------------------------------
    // 2. HERO SECTION MANAGEMENT
    // ------------------------------------------------------------------------
    public function hero()
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $settingModel = new SettingModel();
        return view('admin/hero', [
            'active_tab' => 'hero',
            'settings'   => $settingModel->getAllSettingsAsMap()
        ]);
    }

    public function updateHero()
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $settingModel = new SettingModel();
        $fields = ['hero_badge', 'hero_title', 'hero_subtitle', 'hero_btn1_text', 'hero_btn1_url', 'hero_btn2_text', 'hero_btn2_url'];

        foreach ($fields as $field) {
            if ($this->request->getPost($field) !== null) {
                $settingModel->setSetting($field, esc($this->request->getPost($field)));
            }
        }

        // Check file upload for hero background
        $bgImage = $this->request->getFile('hero_bg_image');
        if ($bgImage && $bgImage->isValid() && !$bgImage->hasMoved()) {
            $newName = $bgImage->getRandomName();
            $bgImage->move(FCPATH . 'uploads/settings', $newName);
            $settingModel->setSetting('hero_bg_image', 'uploads/settings/' . $newName);
        }

        return redirect()->to(base_url('admin/hero'))->with('success', 'Pengaturan Hero Section di Dashboard berhasil diperbarui!');
    }

    // ------------------------------------------------------------------------
    // 3. DESTINATIONS MANAGEMENT
    // ------------------------------------------------------------------------
    public function destinations()
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $destModel = new DestinationModel();
        $destinations = $destModel->orderBy('id', 'DESC')->findAll();
        foreach ($destinations as &$dest) {
            $images = $destModel->getImages($dest['id']);
            $dest['image'] = !empty($images) ? $images[0]['image'] : 'assets/images/destinations/matras.jpg';
        }

        return view('admin/destinations/index', [
            'active_tab'   => 'destinations',
            'destinations' => $destinations
        ]);
    }

    public function createDestination()
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $db = \Config\Database::connect();
        $facilities = $db->table('facilities')->get()->getResultArray();

        return view('admin/destinations/form', [
            'active_tab'  => 'destinations',
            'destination' => null,
            'all_facilities' => $facilities,
            'dest_facilities' => []
        ]);
    }

    public function saveDestination()
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $destModel = new DestinationModel();
        $db = \Config\Database::connect();

        $data = [
            'name'          => esc($this->request->getPost('name')),
            'slug'          => url_title($this->request->getPost('name'), '-', true),
            'description'   => esc($this->request->getPost('description')),
            'location'      => esc($this->request->getPost('location')),
            'latitude'      => (float) $this->request->getPost('latitude'),
            'longitude'     => (float) $this->request->getPost('longitude'),
            'opening_hours' => esc($this->request->getPost('opening_hours')),
            'ticket_price'  => (float) $this->request->getPost('ticket_price'),
            'status'        => esc($this->request->getPost('status')),
            'created_at'    => date('Y-m-d H:i:s')
        ];

        $destId = $destModel->insert($data, true);

        // Handle Facilities
        $facilities = $this->request->getPost('facilities'); // array of facility IDs
        if (!empty($facilities) && is_array($facilities)) {
            $facData = [];
            foreach ($facilities as $fid) {
                $facData[] = [
                    'destination_id' => $destId,
                    'facility_id'    => (int)$fid
                ];
            }
            $db->table('destination_facilities')->insertBatch($facData);
        }

        // Upload main image if provided
        $imageFile = $this->request->getFile('main_image');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $newName = $imageFile->getRandomName();
            $imageFile->move(FCPATH . 'uploads/destinations', $newName);
            $db->table('destination_images')->insert([
                'destination_id' => $destId,
                'image'          => 'uploads/destinations/' . $newName,
                'caption'        => $data['name'] . ' Main Cover'
            ]);
        }
        
        // Upload gallery images if provided
        $galleryFiles = $this->request->getFileMultiple('gallery_images');
        if ($galleryFiles) {
            foreach ($galleryFiles as $gFile) {
                if ($gFile->isValid() && !$gFile->hasMoved()) {
                    $newName = $gFile->getRandomName();
                    $gFile->move(FCPATH . 'uploads/destinations', $newName);
                    $db->table('destination_images')->insert([
                        'destination_id' => $destId,
                        'image'          => 'uploads/destinations/' . $newName,
                        'caption'        => $data['name'] . ' Gallery Photo'
                    ]);
                }
            }
        }

        return redirect()->to(base_url('admin/destinations'))->with('success', 'Destinasi pantai baru berhasil ditambahkan!');
    }

    public function editDestination($id)
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $destModel = new DestinationModel();
        $db = \Config\Database::connect();
        
        $dest = $destModel->find($id);
        if (!$dest) return redirect()->to(base_url('admin/destinations'))->with('error', 'Destinasi tidak ditemukan.');

        $images = $destModel->getImages($id);
        $dest['images'] = $images;
        
        $facilities = $db->table('facilities')->get()->getResultArray();
        
        $destFacData = $db->table('destination_facilities')->where('destination_id', $id)->get()->getResultArray();
        $destFacIds = array_column($destFacData, 'facility_id');

        return view('admin/destinations/form', [
            'active_tab'  => 'destinations',
            'destination' => $dest,
            'all_facilities' => $facilities,
            'dest_facilities' => $destFacIds
        ]);
    }

    public function updateDestination($id)
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $destModel = new DestinationModel();
        $db = \Config\Database::connect();

        $data = [
            'name'          => esc($this->request->getPost('name')),
            'slug'          => url_title($this->request->getPost('name'), '-', true),
            'description'   => esc($this->request->getPost('description')),
            'location'      => esc($this->request->getPost('location')),
            'latitude'      => (float) $this->request->getPost('latitude'),
            'longitude'     => (float) $this->request->getPost('longitude'),
            'opening_hours' => esc($this->request->getPost('opening_hours')),
            'ticket_price'  => (float) $this->request->getPost('ticket_price'),
            'status'        => esc($this->request->getPost('status'))
        ];

        $destModel->update($id, $data);
        
        // Handle Facilities
        $db->table('destination_facilities')->where('destination_id', $id)->delete();
        $facilities = $this->request->getPost('facilities'); // array of facility IDs
        if (!empty($facilities) && is_array($facilities)) {
            $facData = [];
            foreach ($facilities as $fid) {
                $facData[] = [
                    'destination_id' => $id,
                    'facility_id'    => (int)$fid
                ];
            }
            $db->table('destination_facilities')->insertBatch($facData);
        }

        // Check if new image uploaded to replace or add Main Image
        $imageFile = $this->request->getFile('main_image');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $newName = $imageFile->getRandomName();
            $imageFile->move(FCPATH . 'uploads/destinations', $newName);
            
            // Fetch existing images to replace the cover (the first image)
            $existingImages = $db->table('destination_images')->where('destination_id', $id)->orderBy('id', 'ASC')->get()->getResultArray();
            
            if (!empty($existingImages)) {
                $firstImage = $existingImages[0];
                
                // Delete the old file from server
                if (file_exists(FCPATH . $firstImage['image'])) {
                    @unlink(FCPATH . $firstImage['image']);
                }
                
                // Update the database record of the first image so it remains the cover
                $db->table('destination_images')->where('id', $firstImage['id'])->update([
                    'image'   => 'uploads/destinations/' . $newName,
                    'caption' => $data['name'] . ' Cover'
                ]);
            } else {
                // If no images exist, insert it as the first one
                $db->table('destination_images')->insert([
                    'destination_id' => $id,
                    'image'          => 'uploads/destinations/' . $newName,
                    'caption'        => $data['name'] . ' Cover'
                ]);
            }
        }
        
        // Upload multiple gallery images
        $galleryFiles = $this->request->getFileMultiple('gallery_images');
        if ($galleryFiles) {
            foreach ($galleryFiles as $gFile) {
                if ($gFile->isValid() && !$gFile->hasMoved()) {
                    $newName = $gFile->getRandomName();
                    $gFile->move(FCPATH . 'uploads/destinations', $newName);
                    $db->table('destination_images')->insert([
                        'destination_id' => $id,
                        'image'          => 'uploads/destinations/' . $newName,
                        'caption'        => $data['name'] . ' Gallery Photo'
                    ]);
                }
            }
        }

        return redirect()->to(base_url('admin/destinations'))->with('success', 'Data destinasi berhasil diperbarui!');
    }

    public function deleteDestination($id)
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $destModel = new DestinationModel();
        $destModel->delete($id);

        return redirect()->to(base_url('admin/destinations'))->with('success', 'Destinasi pantai berhasil dihapus!');
    }

    public function deleteDestinationImage($imageId)
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $db = \Config\Database::connect();
        
        $image = $db->table('destination_images')->where('id', $imageId)->get()->getRowArray();
        
        if ($image) {
            $destId = $image['destination_id'];
            
            // Optionally delete the physical file
            if (file_exists(FCPATH . $image['image'])) {
                unlink(FCPATH . $image['image']);
            }
            
            $db->table('destination_images')->where('id', $imageId)->delete();
            return redirect()->to(base_url('admin/destinations/edit/' . $destId))->with('success', 'Foto galeri resmi berhasil dihapus!');
        }

        return redirect()->back()->with('error', 'Foto tidak ditemukan.');
    }

    // ------------------------------------------------------------------------
    // 4. GALLERY JOURNAL STORIES MANAGEMENT
    // ------------------------------------------------------------------------
    public function gallery()
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $galleryModel = new GalleryModel();
        $destModel = new DestinationModel();
        $userPhotoModel = new DestinationUserGalleryModel();

        $officialItems = $galleryModel->orderBy('id', 'DESC')->findAll();
        $approvedUserPhotos = $userPhotoModel->where('status', 'approved')->orderBy('created_at', 'DESC')->findAll();

        $allItems = [];
        
        foreach ($officialItems as $item) {
            $dest = $item['destination_id'] ? $destModel->find($item['destination_id']) : null;
            $item['destination_name'] = $dest ? $dest['name'] : 'Umum (Bangka Coast)';
            $item['source_type'] = 'official';
            $item['mixed_id'] = 'official_' . $item['id'];
            $item['img_src'] = $item['image'];
            $allItems[] = $item;
        }

        foreach ($approvedUserPhotos as $photo) {
            $dest = $photo['destination_id'] ? $destModel->find($photo['destination_id']) : null;
            $photo['destination_name'] = $dest ? $dest['name'] : 'Umum (Bangka Coast)';
            $photo['source_type'] = 'user';
            $photo['mixed_id'] = 'user_' . $photo['id'];
            $photo['img_src'] = $photo['image_path'];
            $allItems[] = $photo;
        }

        // Sort: show_on_dashboard == 1 first, then leave rest as is
        usort($allItems, function($a, $b) {
            $aShow = (int)$a['show_on_dashboard'];
            $bShow = (int)$b['show_on_dashboard'];
            if ($aShow === $bShow) {
                return 0; 
            }
            return $aShow > $bShow ? -1 : 1;
        });

        $hasDashboard = false;
        foreach ($allItems as $i) {
            if ($i['show_on_dashboard'] == 1) {
                $hasDashboard = true;
                break;
            }
        }

        return view('admin/gallery/index', [
            'active_tab'   => 'gallery',
            'gallery'      => $allItems,
            'destinations' => $destModel->findAll(),
            'hasDashboard' => $hasDashboard
        ]);
    }

    // Bulk delete selected gallery items
    public function bulkDeleteGallery()
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $ids = $this->request->getPost('selected_ids');
        if (!empty($ids) && is_array($ids)) {
            foreach ($ids as $mixed_id) {
                if (strpos($mixed_id, 'official_') === 0) {
                    (new GalleryModel())->delete(str_replace('official_', '', $mixed_id));
                } elseif (strpos($mixed_id, 'user_') === 0) {
                    (new DestinationUserGalleryModel())->delete(str_replace('user_', '', $mixed_id));
                }
            }
        }
        return redirect()->to(base_url('admin/gallery'))->with('success', 'Item(s) galeri berhasil dihapus.');
    }

    // Bulk update dashboard display for selected gallery items
    public function bulkUpdateDashboard()
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $ids = $this->request->getPost('selected_ids');
        
        // Reset all items to not show on dashboard
        (new GalleryModel())->where('show_on_dashboard', 1)->set('show_on_dashboard', 0)->update();
        (new DestinationUserGalleryModel())->where('show_on_dashboard', 1)->set('show_on_dashboard', 0)->update();

        if (!empty($ids) && is_array($ids)) {
            if (count($ids) > 12) {
                return redirect()->to(base_url('admin/gallery'))->with('error', 'Maksimal hanya 12 gambar yang dapat ditampilkan pada Dashboard.');
            }
            foreach ($ids as $mixed_id) {
                if (strpos($mixed_id, 'official_') === 0) {
                    (new GalleryModel())->update(str_replace('official_', '', $mixed_id), ['show_on_dashboard' => 1]);
                } elseif (strpos($mixed_id, 'user_') === 0) {
                    (new DestinationUserGalleryModel())->update(str_replace('user_', '', $mixed_id), ['show_on_dashboard' => 1]);
                }
            }
        }

        return redirect()->to(base_url('admin/gallery'))->with('success', 'Gambar gallery berhasil diperbarui.');
    }

    public function saveGallery()
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $galleryModel = new GalleryModel();
        $imageFile = $this->request->getFile('image');
        $imagePath = 'assets/images/destinations/matras.jpg';

        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $newName = $imageFile->getRandomName();
            $imageFile->move(FCPATH . 'uploads/gallery', $newName);
            $imagePath = 'uploads/gallery/' . $newName;
        }

        $galleryModel->insert([
            'destination_id' => (int) $this->request->getPost('destination_id') ?: null,
            'title'          => esc($this->request->getPost('title')),
            'description'    => esc($this->request->getPost('description')),
            'image'          => $imagePath,
            'created_at'     => date('Y-m-d H:i:s')
        ]);

        return redirect()->to(base_url('admin/gallery'))->with('success', 'Cerita & foto galeri baru berhasil ditambahkan!');
    }

    public function deleteGallery($mixed_id)
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        if (strpos($mixed_id, 'official_') === 0) {
            (new GalleryModel())->delete(str_replace('official_', '', $mixed_id));
        } elseif (strpos($mixed_id, 'user_') === 0) {
            (new DestinationUserGalleryModel())->delete(str_replace('user_', '', $mixed_id));
        }

        return redirect()->to(base_url('admin/gallery'))->with('success', 'Item galeri berhasil dihapus!');
    }

    // ------------------------------------------------------------------------
    // 5. MAP & ACCOMMODATIONS MANAGEMENT
    // ------------------------------------------------------------------------
    public function map()
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $destModel = new DestinationModel();

        return view('admin/map/index', [
            'active_tab'   => 'map',
            'destinations' => $destModel->findAll()
        ]);
    }

    // ------------------------------------------------------------------------
    // 6. CONTACT MESSAGES MANAGEMENT
    // ------------------------------------------------------------------------
    public function contacts()
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $db = \Config\Database::connect();
        $messages = $db->table('contact_messages')->orderBy('created_at', 'DESC')->get()->getResultArray();

        return view('admin/contacts/index', [
            'active_tab' => 'contacts',
            'messages'   => $messages
        ]);
    }

    public function deleteContact($id)
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $db = \Config\Database::connect();
        $db->table('contact_messages')->where('id', $id)->delete();

        return redirect()->to(base_url('admin/contacts'))->with('success', 'Pesan kontak masuk berhasil dihapus!');
    }

    // ------------------------------------------------------------------------
    // 6.5. CONTACT SETTINGS MANAGEMENT
    // ------------------------------------------------------------------------
    public function settings()
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $settingModel = new SettingModel();
        
        return view('admin/settings/index', [
            'active_tab' => 'settings',
            'settings' => $settingModel->getAllSettings()
        ]);
    }

    public function updateSettings()
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $settingModel = new SettingModel();

        $keys = ['contact_address', 'contact_phone', 'contact_email', 'contact_hours'];
        foreach ($keys as $key) {
            $val = $this->request->getPost($key);
            if ($val !== null) {
                $settingModel->setSetting($key, $val);
            }
        }

        return redirect()->to(base_url('admin/settings'))->with('success', 'Pengaturan Kontak / Pusat Informasi berhasil diperbarui!');
    }

    // ------------------------------------------------------------------------
    // 7. USER REVIEWS VERIFICATION / MODERATION
    // ------------------------------------------------------------------------
    public function reviews()
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $reviewModel = new ReviewModel();
        $destModel = new DestinationModel();

        $statusFilter = $this->request->getGet('status') ?: 'pending';
        if ($statusFilter === 'all') {
            $reviews = $reviewModel->orderBy('created_at', 'DESC')->findAll();
        } else {
            $reviews = $reviewModel->where('status', $statusFilter)->orderBy('created_at', 'DESC')->findAll();
        }

        foreach ($reviews as &$rev) {
            $dest = $destModel->find($rev['destination_id']);
            $rev['destination_name'] = $dest ? $dest['name'] : 'Pantai Matras';
        }

        return view('admin/reviews/index', [
            'active_tab' => 'reviews',
            'status'     => $statusFilter,
            'reviews'    => $reviews
        ]);
    }

    public function approveReview($id)
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $reviewModel = new ReviewModel();
        $reviewModel->update($id, ['status' => 'approved']);

        return redirect()->back()->with('success', 'Review berhasil disetujui (Approved) dan langsung ditampilkan di halaman pantai!');
    }

    public function rejectReview($id)
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $reviewModel = new ReviewModel();
        $reviewModel->update($id, ['status' => 'rejected']);

        return redirect()->back()->with('success', 'Review telah ditolak (Rejected).');
    }

    public function deleteReview($id)
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $reviewModel = new ReviewModel();
        $reviewModel->delete($id);

        return redirect()->back()->with('success', 'Review berhasil dihapus secara permanen.');
    }

    // ------------------------------------------------------------------------
    // 8. USER CONTRIBUTED PHOTOS MODERATION
    // ------------------------------------------------------------------------
    public function photos()
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $userPhotoModel = new DestinationUserGalleryModel();
        $destModel = new DestinationModel();

        $statusFilter = $this->request->getGet('status') ?: 'pending';
        if ($statusFilter === 'all') {
            $photos = $userPhotoModel->orderBy('created_at', 'DESC')->findAll();
        } else {
            $photos = $userPhotoModel->where('status', $statusFilter)->orderBy('created_at', 'DESC')->findAll();
        }

        foreach ($photos as &$photo) {
            $dest = $destModel->find($photo['destination_id']);
            $photo['destination_name'] = $dest ? $dest['name'] : 'Pantai Matras';
        }

        return view('admin/photos/index', [
            'active_tab' => 'photos',
            'status'     => $statusFilter,
            'photos'     => $photos
        ]);
    }

    public function approvePhoto($id)
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $userPhotoModel = new DestinationUserGalleryModel();
        $userPhotoModel->update($id, ['status' => 'approved']);

        return redirect()->back()->with('success', 'Foto wisatawan berhasil disetujui (Approved) dan sekarang tayang di Galeri Wisatawan pantai bersangkutan!');
    }

    public function rejectPhoto($id)
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $userPhotoModel = new DestinationUserGalleryModel();
        $userPhotoModel->update($id, ['status' => 'rejected']);

        return redirect()->back()->with('success', 'Foto wisatawan ditolak (Rejected).');
    }

    public function deletePhoto($id)
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $userPhotoModel = new DestinationUserGalleryModel();
        $userPhotoModel->delete($id);

        return redirect()->back()->with('success', 'Foto wisatawan berhasil dihapus dari database.');
    }

    // ------------------------------------------------------------------------
    // 9. ENTRANCE LOGS (PENGUNJUNG MASUK)
    // ------------------------------------------------------------------------
    public function entrance()
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $entranceModel = new \App\Models\EntranceLogModel();
        
        // Helper to get total amount by date range
        $getTotal = function($startDate, $endDate = null) use ($entranceModel) {
            $builder = $entranceModel->builder();
            $builder->selectSum('amount', 'total');
            if ($endDate) {
                $builder->where('created_at >=', $startDate . ' 00:00:00')
                        ->where('created_at <=', $endDate . ' 23:59:59');
            } else {
                $builder->like('created_at', $startDate);
            }
            $result = $builder->get()->getRowArray();
            return $result ? (int) $result['total'] : 0;
        };

        $today = date('Y-m-d');
        // Monday this week
        $startOfWeek = date('Y-m-d', strtotime('monday this week'));
        $endOfWeek = date('Y-m-d', strtotime('sunday this week'));
        $thisMonth = date('Y-m');

        $totalToday = $getTotal($today);
        $totalWeek = $getTotal($startOfWeek, $endOfWeek);
        $totalMonth = $getTotal($thisMonth);

        // Fetch logs for today
        $history = $entranceModel->like('created_at', $today)->orderBy('id', 'DESC')->findAll();

        // Custom Filter Logic
        $filterStart = $this->request->getGet('start_date');
        $filterEnd = $this->request->getGet('end_date');

        // Chart Data - Last 7 days or Custom
        $chartDataDay = ['labels' => [], 'data' => []];
        if ($filterStart && $filterEnd) {
            try {
                $begin = new \DateTime($filterStart);
                $end = new \DateTime($filterEnd);
                $end->modify('+1 day');
                $interval = \DateInterval::createFromDateString('1 day');
                $period = new \DatePeriod($begin, $interval, $end);

                foreach ($period as $dt) {
                    $date = $dt->format("Y-m-d");
                    $chartDataDay['labels'][] = $dt->format("d M");
                    $chartDataDay['data'][] = $getTotal($date);
                }
            } catch (\Exception $e) {
                // fallback
            }
        } else {
            for ($i = 6; $i >= 0; $i--) {
                $date = date('Y-m-d', strtotime("-$i days"));
                $chartDataDay['labels'][] = date('d M', strtotime($date));
                $chartDataDay['data'][] = $getTotal($date);
            }
        }

        // Chart Data - Last 4 weeks
        $chartDataWeek = ['labels' => [], 'data' => []];
        for ($i = 3; $i >= 0; $i--) {
            $start = date('Y-m-d', strtotime("-$i weeks monday this week"));
            $end = date('Y-m-d', strtotime("-$i weeks sunday this week"));
            $chartDataWeek['labels'][] = date('d M', strtotime($start)) . ' - ' . date('d M', strtotime($end));
            $chartDataWeek['data'][] = $getTotal($start, $end);
        }

        // Chart Data - This Year (by month)
        $chartDataMonth = ['labels' => [], 'data' => []];
        for ($i = 1; $i <= 12; $i++) {
            $month = date('Y-') . str_pad($i, 2, '0', STR_PAD_LEFT);
            $chartDataMonth['labels'][] = date('M', mktime(0, 0, 0, $i, 10));
            $chartDataMonth['data'][] = $getTotal($month);
        }

        return view('admin/entrance/index', [
            'active_tab' => 'entrance',
            'header_title' => 'Pengunjung Masuk',
            'total_today' => $totalToday,
            'total_week' => $totalWeek,
            'total_month' => $totalMonth,
            'history' => $history,
            'chart_day' => $chartDataDay,
            'chart_week' => $chartDataWeek,
            'chart_month' => $chartDataMonth
        ]);
    }

    public function addEntrance()
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $amount = (int) $this->request->getPost('amount');
        if ($amount === 0) {
            return redirect()->back();
        }

        $entranceModel = new \App\Models\EntranceLogModel();
        
        $today = date('Y-m-d');
        $builder = $entranceModel->builder();
        $builder->selectSum('amount', 'total');
        $builder->like('created_at', $today);
        $result = $builder->get()->getRowArray();
        $currentTotal = $result ? (int) $result['total'] : 0;
        
        $totalAfter = $currentTotal + $amount;
        if ($totalAfter < 0) $totalAfter = 0; // Prevent negative total

        // Save log
        $entranceModel->insert([
            'amount' => $amount,
            'total_after' => $totalAfter,
            'admin_name' => session()->get('admin_name') ?: 'Admin'
        ]);

        return redirect()->back()->with('success', 'Berhasil mencatat pengunjung.');
    }

    public function resetEntrance()
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $entranceModel = new \App\Models\EntranceLogModel();
        
        // Determine amount to subtract to reach 0
        $today = date('Y-m-d');
        $builder = $entranceModel->builder();
        $builder->selectSum('amount', 'total');
        $builder->like('created_at', $today);
        $result = $builder->get()->getRowArray();
        $currentTotal = $result ? (int) $result['total'] : 0;

        if ($currentTotal > 0) {
            $entranceModel->insert([
                'amount' => -$currentTotal,
                'total_after' => 0,
                'admin_name' => session()->get('admin_name') ?: 'Admin (Reset)'
            ]);
        }

        return redirect()->back()->with('success', 'Hitungan hari ini berhasil direset.');
    }

    // ------------------------------------------------------------------------
    // 12. INFORMATION MANAGEMENT
    // ------------------------------------------------------------------------
    public function information()
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $infoModel = new \App\Models\InformationModel();
        
        return view('admin/information/index', [
            'active_tab' => 'information',
            'information' => $infoModel->orderBy('id', 'DESC')->findAll()
        ]);
    }

    public function saveInformation()
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $infoModel = new \App\Models\InformationModel();

        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description')
        ];

        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/information', $newName);
            $data['image_path'] = 'uploads/information/' . $newName;
        } else {
            // Jika tambah data baru (tanpa ID) dan gambar gagal, berikan error
            if (!$this->request->getPost('id')) {
                return redirect()->back()->with('error', 'Gagal mengupload gambar atau gambar tidak valid.');
            }
        }

        if ($this->request->getPost('id')) {
            $infoModel->update($this->request->getPost('id'), $data);
            $msg = 'Informasi berhasil diperbarui.';
        } else {
            $infoModel->insert($data);
            $msg = 'Informasi baru berhasil ditambahkan.';
        }

        return redirect()->back()->with('success', $msg);
    }

    public function deleteInformation(int $id)
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $infoModel = new \App\Models\InformationModel();
        $item = $infoModel->find($id);

        if ($item) {
            // Delete image file if exists
            if (!empty($item['image_path']) && file_exists(FCPATH . $item['image_path'])) {
                unlink(FCPATH . $item['image_path']);
            }
            $infoModel->delete($id);
            return redirect()->back()->with('success', 'Informasi berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }

    public function exportEntrance()
    {
        if (!$this->checkAuth()) return redirect()->to(base_url('auth/login'));

        $entranceModel = new \App\Models\EntranceLogModel();
        
        $filterStart = $this->request->getGet('start_date');
        $filterEnd = $this->request->getGet('end_date');
        $groupBy = $this->request->getGet('group_by');

        $builder = $entranceModel->builder();
        
        if ($filterStart && $filterEnd) {
            $builder->where('created_at >=', $filterStart . ' 00:00:00')
                    ->where('created_at <=', $filterEnd . ' 23:59:59');
            $filename = 'Data_Pengunjung_' . $filterStart . '_sd_' . $filterEnd;
        } else {
            $filename = 'Data_Pengunjung_Keseluruhan';
        }

        if ($groupBy === 'day') {
            $builder->select('DATE(created_at) as period, SUM(amount) as total');
            $builder->groupBy('DATE(created_at)');
            $filename .= '_Per_Hari.csv';
            $header = ['No', 'Tanggal', 'Total Pengunjung'];
        } elseif ($groupBy === 'week') {
            $builder->select('YEARWEEK(created_at, 1) as period, SUM(amount) as total');
            $builder->groupBy('YEARWEEK(created_at, 1)');
            $filename .= '_Per_Minggu.csv';
            $header = ['No', 'Tahun & Minggu Ke-', 'Total Pengunjung'];
        } elseif ($groupBy === 'month') {
            $builder->select('DATE_FORMAT(created_at, "%Y-%m") as period, SUM(amount) as total');
            $builder->groupBy('DATE_FORMAT(created_at, "%Y-%m")');
            $filename .= '_Per_Bulan.csv';
            $header = ['No', 'Bulan', 'Total Pengunjung'];
        } elseif ($groupBy === 'year') {
            $builder->select('YEAR(created_at) as period, SUM(amount) as total');
            $builder->groupBy('YEAR(created_at)');
            $filename .= '_Per_Tahun.csv';
            $header = ['No', 'Tahun', 'Total Pengunjung'];
        } else {
            // Raw logs
            $builder->select('created_at as period, amount, total_after');
            $filename .= '.csv';
            $header = ['No', 'Tanggal Waktu', 'Penambahan Pengunjung', 'Total Akumulasi'];
        }
        
        $builder->orderBy('period', 'ASC');
        $logs = $builder->get()->getResultArray();

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);

        $output = fopen('php://output', 'w');
        // Add UTF-8 BOM for Excel
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        
        // Use semicolon delimiter for Indonesian/European Excel locales
        fputcsv($output, $header, ';');

        $no = 1;
        foreach ($logs as $log) {
            if (in_array($groupBy, ['day', 'week', 'month', 'year'])) {
                fputcsv($output, [
                    $no++,
                    $log['period'],
                    $log['total']
                ], ';');
            } else {
                fputcsv($output, [
                    $no++,
                    $log['period'],
                    $log['amount'],
                    $log['total_after']
                ], ';');
            }
        }

        fclose($output);
        exit;
    }

    // ==========================================
    // Shorts Management
    // ==========================================
    public function shorts()
    {
        $shortModel = new \App\Models\ShortModel();
        $data = [
            'title'      => 'Kelola Video Shorts - Admin Panel',
            'header_title' => 'Manajemen Video Shorts',
            'active_tab' => 'shorts',
            'shorts'     => $shortModel->orderBy('id', 'DESC')->findAll()
        ];
        return view('admin/shorts', $data);
    }

    public function saveShort()
    {
        $shortModel = new \App\Models\ShortModel();
        
        $id = $this->request->getPost('id');
        
        $data = [
            'title'       => $this->request->getPost('title'),
            'youtube_url' => $this->request->getPost('youtube_url'),
            'description' => $this->request->getPost('description')
        ];

        if ($id) {
            $shortModel->update($id, $data);
            return redirect()->to('admin/shorts')->with('success', 'Video short berhasil diperbarui.');
        } else {
            $shortModel->insert($data);
            return redirect()->to('admin/shorts')->with('success', 'Video short berhasil ditambahkan.');
        }
    }

    public function deleteShort($id)
    {
        $shortModel = new \App\Models\ShortModel();
        $shortModel->delete($id);
        return redirect()->to('admin/shorts')->with('success', 'Video short berhasil dihapus.');
    }
}
