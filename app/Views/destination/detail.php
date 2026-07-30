<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>

<!-- Detail Hero Banner -->
<section class="detail-hero" style="background-image: linear-gradient(rgba(15, 23, 42, 0.3), rgba(15, 23, 42, 0.75)), url('<?= base_url($images[0]['image'] ?? 'assets/images/destinations/matras.jpg') ?>');">
    <div class="container">
        <div class="detail-hero-content reveal active">
            <span class="badge-category" style="background-color: var(--color-primary); color: var(--color-white);"><?= esc($destination['location']) ?></span>
            <h1 class="detail-title"><?= esc($destination['name']) ?></h1>
            <div class="detail-meta-row">
                <span class="meta-item">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    Buka: <?= esc($destination['opening_hours']) ?>
                </span>
                <span class="meta-item">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    Musim Terbaik: Mei — September
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Detail Content Section -->
<section class="section-padding">
    <div class="container">
        <div class="detail-grid">
            <!-- Left Main Column -->
            <div class="detail-main">
                <!-- Overview -->
                <div class="reveal">
                    <h2 class="detail-section-title">Sekilas Tentang Destinasi</h2>
                    <p class="detail-text"><?= esc($destination['description']) ?></p>
                </div>

                <!-- History -->
                <div class="reveal">
                    <h2 class="detail-section-title">Sejarah & Daya Tarik</h2>
                    <p class="detail-text"><?= esc($destination['history']) ?></p>
                </div>

                <!-- Slideshow -->
                <?php if (!empty($images)): ?>
                    <div class="reveal">
                        <style>
                            .detail-slideshow .official-slide-btn {
                                opacity: 0;
                                transition: all 0.3s ease;
                            }
                            .detail-slideshow:hover .official-slide-btn {
                                opacity: 1;
                            }
                            .detail-slideshow .official-slide-btn:hover {
                                background: rgba(0,0,0,0.6) !important;
                            }
                        </style>
                        <h2 class="detail-section-title">Galeri Foto Resmi</h2>
                        <div class="detail-slideshow" style="position: relative; max-width: 100%; height: 500px; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.1); background: #0f172a;">
                            <!-- images -->
                            <?php foreach ($images as $index => $img): ?>
                                <img class="official-slide-img <?= $index === 0 ? 'active' : '' ?>" 
                                     src="<?= base_url($img['image']) ?>" 
                                     alt="<?= esc($destination['name']) ?>" 
                                     style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; opacity: <?= $index === 0 ? '1' : '0' ?>; display: <?= $index === 0 ? 'block' : 'none' ?>; transition: opacity 0.5s ease-in-out;">
                            <?php endforeach; ?>
                            
                            <!-- prev/next buttons -->
                            <button class="official-slide-btn official-slide-prev" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.3); backdrop-filter: blur(4px); color: white; border: none; width: 45px; height: 45px; border-radius: 50%; cursor: pointer; font-size: 1.2rem; display: flex; align-items: center; justify-content: center; z-index: 10;">&#10094;</button>
                            <button class="official-slide-btn official-slide-next" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.3); backdrop-filter: blur(4px); color: white; border: none; width: 45px; height: 45px; border-radius: 50%; cursor: pointer; font-size: 1.2rem; display: flex; align-items: center; justify-content: center; z-index: 10;">&#10095;</button>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Facilities -->
                <?php if (!empty($facilities)): ?>
                    <div class="reveal">
                        <h2 class="detail-section-title">Fasilitas Tersedia</h2>
                        <div class="facilities-detail-grid">
                            <?php foreach ($facilities as $facility): ?>
                                <div class="facility-detail-item">
                                    <img src="<?= base_url('assets/images/icons/' . $facility['icon'] . '.svg') ?>" alt="<?= esc($facility['name']) ?>" width="20" height="20">
                                    <span><?= esc($facility['name']) ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Community Photo Gallery Section -->
                <div class="reveal" id="user-gallery-section" style="margin-top: 3.5rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem;">
                        <div>
                            <h2 class="detail-section-title" style="margin-bottom: 0.25rem;">Galeri Foto Wisatawan</h2>
                            <p style="color: var(--color-dark-muted); font-size: 0.95rem;">Foto dan momen indah dari pengunjung <?= esc($destination['name']) ?></p>
                        </div>
                        <button type="button" class="btn btn-primary btn-upload-gallery" id="btnOpenGalleryModal" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; font-weight: 700; background: linear-gradient(135deg, var(--color-primary), #0d9488); box-shadow: var(--shadow-md);">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="18" height="18">
                                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                <circle cx="12" cy="13" r="4"></circle>
                            </svg>
                            Kirimkan Gambar
                        </button>
                    </div>

                    <!-- Flash Messages for Gallery Success / Error -->
                    <?php if (session()->getFlashdata('gallery_success')): ?>
                        <div class="alert-box alert-success" style="background-color: #d1fae5; color: #065f46; border: 1px solid #6ee7b7; padding: 1rem 1.25rem; border-radius: var(--border-radius-md); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-weight: 600;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                            <?= session()->getFlashdata('gallery_success') ?>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('gallery_error')): ?>
                        <div class="alert-box alert-error" style="background-color: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; padding: 1rem 1.25rem; border-radius: var(--border-radius-md); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-weight: 600;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                            <?= session()->getFlashdata('gallery_error') ?>
                        </div>
                    <?php endif; ?>

                    <!-- User Photos Grid -->
                    <?php if (empty($userPhotos)): ?>
                        <div style="text-align: center; padding: 3rem 1rem; background: var(--color-white); border: 1px dashed var(--color-light-border); border-radius: var(--border-radius-md);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 1rem display: block;"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                            <p style="color: var(--color-dark-muted); margin-bottom: 0;">Belum ada foto wisatawan yang diupload untuk pantai ini. Jadilah yang pertama mengirimkan gambar Anda!</p>
                        </div>
                    <?php else: ?>
                        <div class="user-photos-grid">
                            <?php foreach ($userPhotos as $index => $photo): ?>
                                <div class="user-photo-card" 
                                     data-lightbox
                                     data-title="<?= esc($photo['title']) ?>" 
                                     data-desc="<?= esc($photo['description']) ?>" 
                                     data-name="<?= esc($photo['name']) ?>" 
                                     data-phone="<?= esc($photo['phone']) ?>" 
                                     data-date="<?= date('d M Y', strtotime($photo['created_at'])) ?>" 
                                     data-img="<?= base_url($photo['image_path']) ?>"
                                     <?= $index >= 8 ? 'data-hidden="true"' : '' ?>
                                     style="position: relative; height: 260px; border-radius: var(--border-radius-md); overflow: hidden; box-shadow: var(--shadow-sm); cursor: pointer; background: #f1f5f9; <?= $index >= 8 ? 'display: none;' : '' ?>">
                                    <img src="<?= base_url($photo['image_path']) ?>" alt="<?= esc($photo['title']) ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);">
                                    <div class="photo-tile-overlay" style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(15, 23, 42, 0.85) 0%, rgba(15, 23, 42, 0.15) 50%, transparent 100%); opacity: 0; transition: opacity 0.3s ease; display: flex; flex-direction: column; justify-content: flex-end; padding: 1.25rem;">
                                        <span style="color: #fff; font-weight: 700; font-size: 1.05rem; line-height: 1.3; margin-bottom: 4px; text-shadow: 0 2px 4px rgba(0,0,0,0.5); display: block;"><?= esc($photo['title']) ?></span>
                                        <div style="display: flex; align-items: center; gap: 6px; color: #99f6e4; font-size: 0.82rem; font-weight: 600;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                            <?= esc($photo['name']) ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <?php if (count($userPhotos) > 8): ?>
                        <div style="text-align: center; margin-top: 2.5rem;">
                            <button id="btnLoadMoreUserPhotos" class="btn btn-outline-primary" style="font-weight: 700; padding: 10px 28px; border-radius: 50px;">
                                Tampilkan Lebih Banyak
                            </button>
                        </div>
                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const btnLoadMore = document.getElementById('btnLoadMoreUserPhotos');
                            if (btnLoadMore) {
                                btnLoadMore.addEventListener('click', function() {
                                    const hiddenItems = document.querySelectorAll('.user-photo-card[data-hidden="true"]');
                                    const itemsToShow = 8;
                                    
                                    if (hiddenItems.length === 0) {
                                        btnLoadMore.style.display = 'none';
                                        return;
                                    }
                                    
                                    for (let i = 0; i < itemsToShow && i < hiddenItems.length; i++) {
                                        hiddenItems[i].style.display = 'block';
                                        hiddenItems[i].removeAttribute('data-hidden');
                                    }
                                    
                                    const remainingHidden = document.querySelectorAll('.user-photo-card[data-hidden="true"]');
                                    if (remainingHidden.length === 0) {
                                        btnLoadMore.style.display = 'none';
                                    }
                                });
                            }
                        });
                        </script>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <!-- User Reviews & Ratings Section -->
                <div class="reveal" id="reviews-section" style="margin-top: 3.5rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem;">
                        <div>
                            <h2 class="detail-section-title" style="margin-bottom: 0.25rem;">Review & Rating Wisatawan</h2>
                            <p style="color: var(--color-dark-muted); font-size: 0.95rem;">Pengalaman nyata wisatawan yang mengunjungi <?= esc($destination['name']) ?></p>
                        </div>
                        <button type="button" class="btn btn-primary btn-write-review" id="btnOpenReviewModal" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; font-weight: 700; box-shadow: var(--shadow-md);">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="18" height="18">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                            </svg>
                            Berikan Review
                        </button>
                    </div>

                    <!-- Flash Messages for Success / Error -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert-box alert-success" style="background-color: #d1fae5; color: #065f46; border: 1px solid #6ee7b7; padding: 1rem 1.25rem; border-radius: var(--border-radius-md); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-weight: 600;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert-box alert-error" style="background-color: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; padding: 1rem 1.25rem; border-radius: var(--border-radius-md); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-weight: 600;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <!-- Reviews Summary Card -->
                    <div class="reviews-summary-card" style="background: var(--color-primary-light); border: 1px solid rgba(10, 168, 167, 0.2); border-radius: var(--border-radius-lg); padding: 2rem; display: grid; grid-template-columns: 1fr 2fr; gap: 2rem; align-items: center; margin-bottom: 2.5rem;">
                        <div class="summary-score" style="text-align: center; border-right: 1px solid rgba(10, 168, 167, 0.2); padding-right: 1.5rem;">
                            <div style="font-size: 3.5rem; font-weight: 800; color: var(--color-primary-dark); line-height: 1;">
                                <?= number_format($ratingStats['avg_rating'] ?? 4.8, 1) ?>
                            </div>
                            <div class="stars-outer" style="color: #F59E0B; font-size: 1.25rem; margin: 0.5rem 0;">
                                <?php
                                    $avg = round($ratingStats['avg_rating'] ?? 5);
                                    for ($i = 1; $i <= 5; $i++) {
                                        echo $i <= $avg ? '★' : '☆';
                                    }
                                ?>
                            </div>
                            <div style="font-size: 0.85rem; color: var(--color-dark-muted); font-weight: 600;">
                                Berdasarkan <?= $ratingStats['total_reviews'] ?? 0 ?> review wisatawan
                            </div>
                        </div>

                        <div class="summary-bars" style="display: flex; flex-direction: column; gap: 0.5rem;">
                            <?php 
                            $totalRev = max(1, $ratingStats['total_reviews'] ?? 1);
                            for ($star = 5; $star >= 1; $star--): 
                                $count = $ratingStats['breakdown'][$star] ?? 0;
                                $pct = round(($count / $totalRev) * 100);
                            ?>
                                <div style="display: flex; align-items: center; gap: 12px; font-size: 0.85rem; font-weight: 600; color: var(--color-dark);">
                                    <span style="width: 45px; display: inline-flex; align-items: center; gap: 4px;"><?= $star ?> <span style="color: #F59E0B;">★</span></span>
                                    <div style="flex: 1; height: 8px; background-color: rgba(255,255,255,0.8); border-radius: var(--border-radius-full); overflow: hidden;">
                                        <div style="height: 100%; width: <?= $pct ?>%; background-color: #F59E0B; border-radius: var(--border-radius-full);"></div>
                                    </div>
                                    <span style="width: 30px; text-align: right; color: var(--color-dark-muted); font-size: 0.8rem;"><?= $count ?></span>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <!-- Reviews List -->
                    <div class="reviews-list-container" style="display: flex; flex-direction: column; gap: 1.5rem; max-height: 700px; overflow-y: auto; padding-right: 1rem;">
                        <?php if (empty($reviews)): ?>
                            <div style="text-align: center; padding: 3rem 1rem; background: var(--color-white); border: 1px dashed var(--color-light-border); border-radius: var(--border-radius-md); width: 100%;">
                                <p style="color: var(--color-dark-muted); margin-bottom: 1rem;">Belum ada review untuk pantai ini. Jadilah yang pertama memberikan review!</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($reviews as $rev): ?>
                                <div class="review-card" style="background: var(--color-white); border: 1px solid var(--color-light-border); border-radius: var(--border-radius-md); padding: 1.5rem; box-shadow: var(--shadow-sm); transition: var(--transition-smooth);">
                                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.75rem; flex-wrap: wrap; gap: 0.5rem;">
                                        <div style="display: flex; align-items: center; gap: 12px;">
                                            <div style="width: 44px; height: 44px; border-radius: 50%; background: linear-gradient(135deg, var(--color-primary), var(--color-accent)); color: white; font-weight: 700; font-size: 1.1rem; display: flex; align-items: center; justify-content: center; text-transform: uppercase; flex-shrink: 0;">
                                                <?= substr(esc($rev['name']), 0, 1) ?>
                                            </div>
                                            <div>
                                                <h4 style="font-size: 1.05rem; font-weight: 700; margin-bottom: 2px; color: var(--color-dark);"><?= esc($rev['name']) ?></h4>
                                            </div>
                                        </div>
                                        <div style="text-align: right;">
                                            <div style="color: #F59E0B; font-size: 1.1rem; letter-spacing: 2px;">
                                                <?php for ($s = 1; $s <= 5; $s++) echo $s <= (int)$rev['rating'] ? '★' : '☆'; ?>
                                            </div>
                                            <span style="font-size: 0.75rem; color: var(--color-dark-muted);">
                                                <?= date('d M Y', strtotime($rev['created_at'])) ?>
                                            </span>
                                        </div>
                                    </div>
                                    <p style="color: var(--color-dark-muted); line-height: 1.6; font-size: 0.95rem; margin-top: 0.5rem; display: -webkit-box; -webkit-line-clamp: 5; -webkit-box-orient: vertical; overflow: hidden;">
                                        "<?= esc($rev['comment']) ?>"
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Review Modal Popup -->
<div id="reviewModal" class="review-modal-backdrop" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999; background: rgba(15, 23, 42, 0.65); backdrop-filter: blur(6px); align-items: center; justify-content: center; padding: 1.5rem;">
    <div class="review-modal-box" style="background: var(--color-white); width: 100%; max-width: 520px; border-radius: var(--border-radius-lg); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35); border: 1px solid var(--color-light-border); overflow: hidden; transform: translateY(20px); opacity: 0; transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);">
        <!-- Modal Header -->
        <div style="background: var(--color-primary-light); padding: 1.5rem; border-bottom: 1px solid rgba(10, 168, 167, 0.2); display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h3 style="font-size: 1.35rem; font-weight: 800; color: var(--color-primary-dark); margin-bottom: 4px;">Berikan Review Anda</h3>
                <p style="font-size: 0.85rem; color: var(--color-dark-muted); margin: 0;">Untuk <?= esc($destination['name']) ?></p>
            </div>
            <button type="button" id="btnCloseReviewModal" style="background: none; border: none; font-size: 1.5rem; color: var(--color-dark-muted); cursor: pointer; padding: 4px 8px; border-radius: 6px; line-height: 1;" aria-label="Close modal">&times;</button>
        </div>

        <!-- Modal Body Form -->
        <form action="<?= base_url('destinations/add-review') ?>" method="post" style="padding: 1.75rem;">
            <?= csrf_field() ?>
            <input type="hidden" name="destination_id" value="<?= esc($destination['id']) ?>">
            <input type="hidden" name="slug" value="<?= esc($destination['slug']) ?>">

            <!-- Nama -->
            <div style="margin-bottom: 1.25rem;">
                <label for="reviewName" style="display: block; font-size: 0.9rem; font-weight: 700; color: var(--color-dark); margin-bottom: 6px;">Nama Lengkap <span style="color: #ef4444;">*</span></label>
                <input type="text" id="reviewName" name="name" required placeholder="Masukkan nama lengkap Anda..." style="width: 100%; padding: 12px 16px; border: 1px solid var(--color-light-border); border-radius: var(--border-radius-md); font-size: 0.95rem; transition: all 0.2s; background: #f8fafc;" value="<?= esc(old('name')) ?>">
            </div>

            <!-- No HP -->
            <div style="margin-bottom: 1.25rem;">
                <label for="reviewPhone" style="display: block; font-size: 0.9rem; font-weight: 700; color: var(--color-dark); margin-bottom: 6px;">Nomor HP / WhatsApp <span style="color: #ef4444;">*</span></label>
                <input type="tel" id="reviewPhone" name="phone" required placeholder="Contoh: 081234567890" style="width: 100%; padding: 12px 16px; border: 1px solid var(--color-light-border); border-radius: var(--border-radius-md); font-size: 0.95rem; transition: all 0.2s; background: #f8fafc;" value="<?= esc(old('phone')) ?>">
            </div>

            <!-- Rating Bintang -->
            <div style="margin-bottom: 1.25rem;">
                <label style="display: block; font-size: 0.9rem; font-weight: 700; color: var(--color-dark); margin-bottom: 8px;">Rating Bintang <span style="color: #ef4444;">*</span></label>
                <div class="star-rating-input" style="display: flex; gap: 10px; align-items: center; direction: rtl; justify-content: flex-end; background: #f8fafc; padding: 12px 16px; border: 1px solid var(--color-light-border); border-radius: var(--border-radius-md);">
                    <?php for ($r = 5; $r >= 1; $r--): ?>
                        <input type="radio" id="star<?= $r ?>" name="rating" value="<?= $r ?>" <?= $r === 5 ? 'checked' : '' ?> style="display: none;">
                        <label for="star<?= $r ?>" title="<?= $r ?> Bintang" class="star-label" style="font-size: 1.8rem; color: #cbd5e1; cursor: pointer; transition: color 0.2s;">★</label>
                    <?php endfor; ?>
                    <span id="ratingValueText" style="margin-right: auto; font-weight: 700; color: #d97706; font-size: 0.95rem;">5.0 &bull; Sangat Puas</span>
                </div>
            </div>

            <!-- Isi Review -->
            <div style="margin-bottom: 1.75rem;">
                <label for="reviewComment" style="display: block; font-size: 0.9rem; font-weight: 700; color: var(--color-dark); margin-bottom: 6px;">Isi Review <span style="color: #ef4444;">*</span></label>
                <textarea id="reviewComment" name="comment" required rows="4" placeholder="Ceritakan pengalaman liburan, keindahan pantai, ataupun fasilitas yang Anda nikmati..." style="width: 100%; padding: 12px 16px; border: 1px solid var(--color-light-border); border-radius: var(--border-radius-md); font-size: 0.95rem; transition: all 0.2s; background: #f8fafc; font-family: inherit; resize: vertical;"><?= esc(old('comment')) ?></textarea>
            </div>

            <!-- Modal Actions -->
            <div style="display: flex; gap: 12px; justify-content: flex-end;">
                <button type="button" id="btnCancelReviewModal" class="btn" style="padding: 12px 20px; background: #e2e8f0; color: #475569; font-weight: 700;">Batal</button>
                <button type="submit" class="btn btn-primary" style="padding: 12px 28px; font-weight: 700; display: inline-flex; align-items: center; gap: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                    Kirim Review
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Gallery Upload Modal Popup -->
<div id="galleryModal" class="review-modal-backdrop" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999; background: rgba(15, 23, 42, 0.65); backdrop-filter: blur(6px); align-items: center; justify-content: center; padding: 1.5rem;">
    <div class="review-modal-box" style="background: var(--color-white); width: 100%; max-width: 560px; border-radius: var(--border-radius-lg); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35); border: 1px solid var(--color-light-border); overflow: hidden; transform: translateY(20px); opacity: 0; transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);">
        <!-- Modal Header -->
        <div style="background: linear-gradient(135deg, var(--color-primary-light), #ccfbf1); padding: 1.5rem; border-bottom: 1px solid rgba(10, 168, 167, 0.2); display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h3 style="font-size: 1.35rem; font-weight: 800; color: var(--color-primary-dark); margin-bottom: 4px;">Kirimkan Gambar Anda</h3>
                <p style="font-size: 0.85rem; color: var(--color-dark-muted); margin: 0;">Bagikan momen terbaik di <?= esc($destination['name']) ?></p>
            </div>
            <button type="button" id="btnCloseGalleryModal" style="background: none; border: none; font-size: 1.5rem; color: var(--color-dark-muted); cursor: pointer; padding: 4px 8px; border-radius: 6px; line-height: 1;" aria-label="Close modal">&times;</button>
        </div>

        <!-- Modal Body Form -->
        <form action="<?= base_url('destinations/add-gallery-photo') ?>" method="post" enctype="multipart/form-data" style="padding: 1.75rem; max-height: 80vh; overflow-y: auto;">
            <?= csrf_field() ?>
            <input type="hidden" name="destination_id" value="<?= esc($destination['id']) ?>">
            <input type="hidden" name="slug" value="<?= esc($destination['slug']) ?>">

            <!-- Nama -->
            <div style="margin-bottom: 1.1rem;">
                <label for="galleryName" style="display: block; font-size: 0.9rem; font-weight: 700; color: var(--color-dark); margin-bottom: 6px;">Nama Lengkap <span style="color: #ef4444;">*</span></label>
                <input type="text" id="galleryName" name="name" required placeholder="Masukkan nama lengkap Anda..." style="width: 100%; padding: 11px 16px; border: 1px solid var(--color-light-border); border-radius: var(--border-radius-md); font-size: 0.95rem; transition: all 0.2s; background: #f8fafc;" value="<?= esc(old('name')) ?>">
            </div>

            <!-- No HP -->
            <div style="margin-bottom: 1.1rem;">
                <label for="galleryPhone" style="display: block; font-size: 0.9rem; font-weight: 700; color: var(--color-dark); margin-bottom: 6px;">Nomor HP / WhatsApp <span style="color: #ef4444;">*</span></label>
                <input type="tel" id="galleryPhone" name="phone" required placeholder="Contoh: 081234567890" style="width: 100%; padding: 11px 16px; border: 1px solid var(--color-light-border); border-radius: var(--border-radius-md); font-size: 0.95rem; transition: all 0.2s; background: #f8fafc;" value="<?= esc(old('phone')) ?>">
            </div>

            <!-- Judul Foto -->
            <div style="margin-bottom: 1.1rem;">
                <label for="galleryTitle" style="display: block; font-size: 0.9rem; font-weight: 700; color: var(--color-dark); margin-bottom: 6px;">Judul Foto / Gambar <span style="color: #ef4444;">*</span></label>
                <input type="text" id="galleryTitle" name="title" required placeholder="Contoh: Senja Memukau di Pantai Matras" style="width: 100%; padding: 11px 16px; border: 1px solid var(--color-light-border); border-radius: var(--border-radius-md); font-size: 0.95rem; transition: all 0.2s; background: #f8fafc;" value="<?= esc(old('title')) ?>">
            </div>

            <!-- Deskripsi Foto -->
            <div style="margin-bottom: 1.25rem;">
                <label for="galleryDescription" style="display: block; font-size: 0.9rem; font-weight: 700; color: var(--color-dark); margin-bottom: 6px;">Deskripsi Singkat <span style="color: #ef4444;">*</span></label>
                <textarea id="galleryDescription" name="description" required rows="3" placeholder="Ceritakan di mana foto diambil, waktu pengambilan, ataupun momen seru di baliknya..." style="width: 100%; padding: 11px 16px; border: 1px solid var(--color-light-border); border-radius: var(--border-radius-md); font-size: 0.95rem; transition: all 0.2s; background: #f8fafc; font-family: inherit; resize: vertical;"><?= esc(old('description')) ?></textarea>
            </div>

            <!-- Pilih Gambar (File Input) -->
            <div style="margin-bottom: 1.75rem;">
                <label style="display: block; font-size: 0.9rem; font-weight: 700; color: var(--color-dark); margin-bottom: 8px;">Pilih File Gambar <span style="color: #ef4444;">*</span></label>
                <div class="custom-file-dropzone" style="border: 2px dashed rgba(10, 168, 167, 0.4); background: #f0fdfa; border-radius: var(--border-radius-md); padding: 1.5rem; text-align: center; cursor: pointer; transition: all 0.2s; position: relative;" id="dropzoneArea">
                    <input type="file" id="galleryPhotoInput" name="image" required accept="image/*" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                    <div id="dropzoneText">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 8px;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                        <p style="margin: 0; font-weight: 700; color: var(--color-primary-dark); font-size: 0.95rem;">Klik atau Geser File Gambar ke Sini</p>
                        <span style="font-size: 0.78rem; color: var(--color-dark-muted);">Format: JPG, PNG, atau WEBP (Maksimal 5MB)</span>
                    </div>
                    <div id="imagePreviewBox" style="display: none; margin-top: 10px;">
                        <img id="previewImageElem" src="" alt="Preview" style="max-height: 160px; border-radius: 8px; box-shadow: var(--shadow-sm); margin: 0 auto; display: block;">
                        <span id="previewFileName" style="display: block; font-size: 0.8rem; font-weight: 600; color: var(--color-primary-dark); margin-top: 6px;"></span>
                    </div>
                </div>
            </div>

            <!-- Modal Actions -->
            <div style="display: flex; gap: 12px; justify-content: flex-end;">
                <button type="button" id="btnCancelGalleryModal" class="btn" style="padding: 12px 20px; background: #e2e8f0; color: #475569; font-weight: 700;">Batal</button>
                <button type="submit" class="btn btn-primary" style="padding: 12px 28px; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, var(--color-primary), #0d9488);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                    Upload & Kirim Gambar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Photo Detail Lightbox Modal -->
<div id="photoDetailModal" class="review-modal-backdrop" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 10000; background: rgba(15, 23, 42, 0.85); backdrop-filter: blur(10px); align-items: center; justify-content: center; padding: 1.5rem;">
    <div class="photo-lightbox-box" style="background: var(--color-white); width: 100%; max-width: 880px; border-radius: var(--border-radius-lg); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); border: 1px solid rgba(255, 255, 255, 0.15); overflow: hidden; display: grid; grid-template-columns: 1.3fr 1fr; transform: scale(0.95); opacity: 0; transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); max-height: 88vh;">
        <!-- Lightbox Image Panel -->
        <div style="background: #0f172a; display: flex; align-items: center; justify-content: center; position: relative; min-height: 380px; overflow: hidden;">
            <img id="lightboxImg" src="" alt="Detail Foto" style="width: 100%; height: 100%; object-fit: contain; max-height: 88vh; display: block;">
        </div>

        <!-- Lightbox Info Panel -->
        <div style="padding: 2rem; display: flex; flex-direction: column; justify-content: space-between; background: var(--color-white); position: relative; overflow-y: auto;">
            <button type="button" id="btnClosePhotoDetailModal" style="position: absolute; top: 1rem; right: 1.25rem; background: #f1f5f9; border: none; width: 36px; height: 36px; border-radius: 50%; font-size: 1.4rem; color: var(--color-dark); cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s;" aria-label="Close modal">&times;</button>
            
            <div>
                <span id="lightboxDate" style="display: inline-block; font-size: 0.78rem; font-weight: 700; color: var(--color-primary-dark); background: var(--color-primary-light); padding: 4px 10px; border-radius: var(--border-radius-full); margin-bottom: 1rem;"></span>
                
                <h3 id="lightboxTitle" style="font-size: 1.35rem; font-weight: 800; color: var(--color-dark); line-height: 1.3; margin-bottom: 1.25rem;"></h3>
                
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 1.5rem; padding-bottom: 1.25rem; border-bottom: 1px solid var(--color-light-border);">
                    <div style="width: 44px; height: 44px; border-radius: 50%; background: linear-gradient(135deg, var(--color-primary), #0d9488); color: white; font-weight: 800; font-size: 1.2rem; display: flex; align-items: center; justify-content: center; text-transform: uppercase; flex-shrink: 0;" id="lightboxAvatar">
                        ?
                    </div>
                    <div>
                        <h4 style="font-size: 1.05rem; font-weight: 700; color: var(--color-dark); margin: 0 0 2px;" id="lightboxName"></h4>
                        <span style="font-size: 0.8rem; color: var(--color-dark-muted); font-weight: 600; display: flex; align-items: center; gap: 6px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                            Kontributor Terverifikasi
                        </span>
                    </div>
                </div>

                <div>
                    <h5 style="font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: var(--color-dark-muted); margin-bottom: 8px;">Deskripsi Foto</h5>
                    <p id="lightboxDesc" style="color: var(--color-dark); font-size: 0.95rem; line-height: 1.6; margin: 0; white-space: pre-line;"></p>
                </div>
            </div>

            <div style="margin-top: 2rem; padding-top: 1rem; border-top: 1px solid var(--color-light-border); display: flex; justify-content: flex-end;">
                <button type="button" id="btnCloseBottomPhotoDetail" class="btn btn-primary" style="padding: 10px 24px; font-weight: 700; border-radius: var(--border-radius-md);">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Celebratory Submission Pop-up Modal -->
<?php 
    $popupMessage = session()->getFlashdata('success') ?: session()->getFlashdata('gallery_success');
    $popupError   = session()->getFlashdata('error') ?: session()->getFlashdata('gallery_error');
?>
<?php if ($popupMessage || $popupError): ?>
<div id="submissionAlertModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 100000; background: rgba(15, 23, 42, 0.75); backdrop-filter: blur(8px); display: flex; align-items: center; justify-content: center; padding: 1.5rem; animation: fadeInModal 0.3s ease;">
    <div style="background: var(--color-white); width: 100%; max-width: 480px; border-radius: 20px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.45); border: 1px solid rgba(255, 255, 255, 0.2); overflow: hidden; text-align: center; padding: 2.5rem 2rem; transform: translateY(0); animation: slideUpModal 0.35s cubic-bezier(0.16, 1, 0.3, 1);">
        <?php if ($popupMessage): ?>
            <div style="width: 72px; height: 72px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.35); color: white;">
                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <h3 style="font-size: 1.6rem; font-weight: 800; color: var(--color-dark); margin: 0 0 10px;">Pengiriman Berhasil! 🎉</h3>
            <p style="color: #475569; font-size: 0.96rem; line-height: 1.6; margin: 0 0 1.75rem;">
                <?= esc($popupMessage) ?>
            </p>
        <?php else: ?>
            <div style="width: 72px; height: 72px; background: linear-gradient(135deg, #ef4444, #dc2626); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem; box-shadow: 0 10px 25px rgba(239, 68, 68, 0.35); color: white;">
                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            </div>
            <h3 style="font-size: 1.6rem; font-weight: 800; color: var(--color-dark); margin: 0 0 10px;">Gagal Mengirim ⚠️</h3>
            <p style="color: #ef4444; font-size: 0.96rem; line-height: 1.6; margin: 0 0 1.75rem; font-weight: 600;">
                <?= esc($popupError) ?>
            </p>
        <?php endif; ?>

        <button type="button" onclick="document.getElementById('submissionAlertModal').style.display='none'" class="btn btn-primary" style="width: 100%; padding: 14px 24px; font-size: 1.05rem; font-weight: 800; border-radius: 12px; background: linear-gradient(135deg, var(--color-primary), #0d9488); box-shadow: 0 4px 14px rgba(10, 168, 167, 0.4); border: none; cursor: pointer;">
            ✓ Mengerti & Tutup
        </button>
    </div>
</div>
<style>
@keyframes fadeInModal {
    from { opacity: 0; }
    to { opacity: 1; }
}
@keyframes slideUpModal {
    from { transform: translateY(30px) scale(0.95); opacity: 0; }
    to { transform: translateY(0) scale(1); opacity: 1; }
}
</style>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.official-slide-img');
    if (slides.length > 0) {
        let currentIndex = 0;
        let slideInterval;
        
        function showSlide(index) {
            slides.forEach((slide, i) => {
                if (i === index) {
                    slide.style.display = 'block';
                    setTimeout(() => slide.style.opacity = '1', 10);
                    slide.classList.add('active');
                } else {
                    slide.style.opacity = '0';
                    setTimeout(() => {
                        if(slide.style.opacity === '0') slide.style.display = 'none';
                    }, 500);
                    slide.classList.remove('active');
                }
            });
        }
        
        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            showSlide(currentIndex);
        }
        
        function prevSlide() {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
            showSlide(currentIndex);
        }
        
        const nextBtn = document.querySelector('.official-slide-next');
        const prevBtn = document.querySelector('.official-slide-prev');
        
        if (nextBtn && prevBtn) {
            nextBtn.addEventListener('click', () => {
                nextSlide();
                resetInterval();
            });
            prevBtn.addEventListener('click', () => {
                prevSlide();
                resetInterval();
            });
        }
        
        function resetInterval() {
            clearInterval(slideInterval);
            slideInterval = setInterval(nextSlide, 3000);
        }
        
        // Auto slide every 3 seconds
        slideInterval = setInterval(nextSlide, 3000);

        // Hover effect for buttons
        const btns = document.querySelectorAll('.official-slide-prev, .official-slide-next');
        btns.forEach(btn => {
            btn.addEventListener('mouseenter', () => btn.style.background = 'rgba(255,255,255,0.4)');
            btn.addEventListener('mouseleave', () => btn.style.background = 'rgba(255,255,255,0.2)');
        });
    }
});
</script>

<?= view('layouts/footer') ?>
<?= view('layouts/scripts') ?>
