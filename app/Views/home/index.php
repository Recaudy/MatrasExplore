<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>

<!-- 1. Hero Section -->
<section class="hero-section" id="dashboard"
    style="background-image: linear-gradient(rgba(15, 23, 42, 0.45), rgba(15, 23, 42, 0.55)), url('<?= esc($settings['hero_bg_image'] ?? 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1920&q=80') ?>');">
    <div class="container">
        <div class="hero-content reveal active">
            <h1>
                <?php 
                    $title = esc($settings['hero_title'] ?? "Temukan Pesona Keindahan Pantai Matras & Sekitarnya");
                    echo str_replace('Temukan Pesona Keindahan', '<span style="color: var(--color-primary);">Temukan Pesona Keindahan</span>', $title);
                ?>
            </h1>
            <p><?= esc($settings['hero_subtitle'] ?? 'Nikmati jernihnya air laut, formasi batuan granit eksotis, dan ketenangan pesisir pantai. Perjalanan liburan tak terlupakan Anda dimulai dari sini.') ?>
            </p>
            <div class="hero-buttons">
                <a href="#destinations" class="btn btn-white">
                    <?= esc($settings['hero_btn1_text'] ?? 'Jelajahi Pantai') ?>
                    
                </a>
                <a href="#map" class="btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    <?= esc($settings['hero_btn2_text'] ?? 'Lihat Peta') ?>
                </a>
            </div>
        </div>
    </div>

    <!-- Curved border SVG divider -->
    <div class="hero-curve">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" preserveAspectRatio="none">
            <path d="M0,0 C480,95 960,95 1440,0 L1440,120 L0,120 Z"></path>
        </svg>
    </div>
</section>

<!-- 2. Destinations Section -->
<section class="section-padding" id="destinations">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-header-left">
                <h2>Tiga Garis Pantai. Tiga Pilihan Wisata.</h2>
                <p>Pilih suasana liburan impian Anda: ramai dan ceria, tenang dan alami, atau dikelilingi bebatuan
                    granit eksotis dan matahari terbenam.</p>
            </div>
            <a href="#map" class="btn btn-outline-primary">
                Jelajahi Peta Wisata
                
            </a>
        </div>

        <div class="destinations-grid">
            <?php foreach ($destinations as $index => $dest): ?>
            <div class="destination-card reveal" style="cursor: pointer;" onclick="window.location.href='<?= base_url('destinations/' . $dest['slug']) ?>'">
                <div class="card-img-wrapper">
                    <img src="<?= base_url($dest['image']) ?>" alt="<?= esc($dest['name']) ?>">
                    <span class="card-rating-badge badge-rating">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#EAB308" stroke="#EAB308"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14">
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                            </polygon>
                        </svg>
                        <?= esc($dest['rating'] ?? '4.7') ?>
                    </span>
                </div>
                <div class="card-content">
                    <span class="card-location"><?= esc($dest['location']) ?></span>
                    <h3 class="card-title"><?= esc($dest['name']) ?></h3>
                    <p class="card-desc"><?= esc($dest['description']) ?></p>

                    <div class="card-meta-bottom">
                        <span class="meta-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                width="16" height="16">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <?= esc(str_replace(['May', 'June', 'July', 'August', 'September', 'October', 'April'], ['Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'April'], $dest['season'] ?? 'Mei — Sept')) ?>
                        </span>
                        <div class="meta-icons">
                            <?php foreach ($dest['facilities'] as $facility): ?>
                            <img src="<?= base_url('assets/images/icons/' . $facility['icon'] . '.svg') ?>"
                                alt="<?= esc($facility['name']) ?>" title="<?= esc($facility['name']) ?>" width="16"
                                height="16">
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- 3. Gallery Section -->
<section class="section-padding gallery-section" id="gallery">
    <div class="container">
        <?php if (session()->getFlashdata('gallery_success')): ?>
        <div
            style="background: #dcfce7; border: 1px solid #22c55e; color: #15803d; padding: 16px; border-radius: var(--border-radius-md); margin-bottom: 2rem; font-weight: 700; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 4px 12px rgba(34, 197, 94, 0.15);">
            <span style="display: flex; align-items: center; gap: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <?= esc(session()->getFlashdata('gallery_success')) ?>
            </span>
            <button type="button" onclick="this.parentElement.style.display='none'"
                style="background: none; border: none; font-size: 1.3rem; cursor: pointer; color: #15803d;">&times;</button>
        </div>
        <?php endif; ?>

        <div class="section-header reveal">
            <h2>Keindahan Laut & Mentari di Ujung Cakrawala.</h2>
            <p>Kumpulan potret pesona pantai dari Explore Bangka serta kiriman foto dari para pengunjung setia — gulir
                atau klik gambar untuk melihat momen lebih dekat.</p>
            <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; margin-top: 1.5rem;">
                <button type="button" class="btn btn-primary" onclick="openHomeGalleryModal()"
                    style="display: inline-flex; align-items: center; gap: 8px; font-weight: 700; padding: 12px 24px; box-shadow: var(--shadow-md);">
                    
                    Kirimkan Gambar
                </button>
                <a href="<?= base_url('gallery') ?>" class="btn btn-outline-primary"
                    style="display: inline-flex; align-items: center; gap: 8px; font-weight: 700; padding: 12px 24px;">
                    Lihat semua galeri
                   
                </a>
            </div>
        </div>

        <style>
        @media (max-width: 992px) {
            #homeGalleryGrid {
                display: grid !important;
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 20px !important;
            }

            #homeGalleryGrid .gallery-card {
                border-radius: var(--border-radius-lg) !important;
                overflow: hidden !important;
                height: auto !important;
                width: 100% !important;
                aspect-ratio: 1 / 1 !important;
            }
        }
        </style>
        <div class="gallery-grid" id="homeGalleryGrid">
            <?php foreach ($gallery as $index => $item): ?>
            <div class="gallery-card gallery-item-<?= $index + 1 ?> reveal" data-lightbox
                data-title="<?= esc($item['title']) ?>" data-desc="<?= esc($item['description']) ?>"
                <?= $index >= 8 ? 'style="display: none;" data-hidden="true"' : '' ?>>
                <img src="<?= base_url($item['image_path'] ?? $item['image']) ?>" alt="<?= esc($item['title']) ?>">
                <div class="gallery-overlay" style="padding: 1.25rem; background: linear-gradient(to top, rgba(15, 23, 42, 0.85) 0%, rgba(15, 23, 42, 0.15) 50%, transparent 100%);">
                    <span style="color: #fff; font-weight: 700; font-size: 1.05rem; line-height: 1.3; margin-bottom: 4px; text-shadow: 0 2px 4px rgba(0,0,0,0.5); display: block;"><?= esc($item['title']) ?></span>
                    <?php if (!empty($item['author'])): ?>
                    <div style="display: flex; align-items: center; gap: 6px; color: #99f6e4; font-size: 0.82rem; font-weight: 600;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <?= esc($item['author']) ?>
                    </div>
                    <?php else: ?>
                    <p style="font-size: 0.8rem; opacity: 0.9; margin: 0; color: rgba(255, 255, 255, 0.85);">Explore Matras</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php if (count($gallery) > 8): ?>
        <div style="text-align: center; margin-top: 3rem;">
            <button id="btnLoadMoreGallery" class="btn btn-outline-primary"
                style="font-weight: 700; padding: 12px 32px; border-radius: 50px;">
                Tampilkan Lebih Banyak
            </button>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnLoadMore = document.getElementById('btnLoadMoreGallery');
            if (btnLoadMore) {
                btnLoadMore.addEventListener('click', function() {
                    const hiddenItems = document.querySelectorAll(
                        '#homeGalleryGrid .gallery-card[data-hidden="true"]');
                    const itemsToShow = 8;

                    if (hiddenItems.length === 0) {
                        btnLoadMore.style.display = 'none';
                        return;
                    }

                    for (let i = 0; i < itemsToShow && i < hiddenItems.length; i++) {
                        hiddenItems[i].style.display = 'block';
                        hiddenItems[i].removeAttribute('data-hidden');

                        // Force reflow for animation if needed
                        setTimeout(() => {
                            hiddenItems[i].classList.add('active');
                        }, 50 * i);
                    }

                    if (hiddenItems.length <= itemsToShow) {
                        btnLoadMore.style.display = 'none';
                    }
                });
            }
        });
        </script>
        <?php endif; ?>
    </div>
</section>

<!-- 3b. Information Section -->
<section class="section-padding" style="background-color: var(--color-light-bg);" id="informasi">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-header-left">
                <h2>Pusat Informasi & Harga Sewa.</h2>
                <p>Temukan informasi terkait daftar harga sewa fasilitas, aturan, dan panduan wisata lainnya. Klik gambar untuk memperbesar.</p>
            </div>
            <a href="<?= base_url('informasi') ?>" class="btn btn-outline-primary" style="display: inline-flex; align-items: center; gap: 8px; font-weight: 700; padding: 12px 24px;">
                Lihat Semua Informasi
               
            </a>
        </div>

        <?php if (!empty($information)): ?>
        <?php 
        $infoCount = count($information);
        $gridCols = $infoCount >= 4 ? 4 : $infoCount;
        $maxWidth = $infoCount == 1 ? '300px' : ($infoCount == 2 ? '600px' : ($infoCount == 3 ? '850px' : '1000px'));
        ?>
        <style>
        #homeInfoGrid {
            display: grid;
            grid-template-columns: repeat(<?= $gridCols ?>, 1fr);
            gap: 1.75rem;
            max-width: <?= $maxWidth ?>;
            margin: 0 auto;
        }
        #homeInfoGrid .gallery-card {
            aspect-ratio: 3 / 4 !important; /* Persegi panjang (Portrait) */
        }
        @media (max-width: 992px) {
            #homeInfoGrid {
                grid-template-columns: repeat(<?= min(2, $gridCols) ?>, 1fr) !important;
                gap: 20px !important;
            }
            #homeInfoGrid .gallery-card {
                border-radius: var(--border-radius-lg) !important;
                overflow: hidden !important;
                height: auto !important;
                width: 100% !important;
            }
        }
        @media (max-width: 576px) {
            #homeInfoGrid {
                grid-template-columns: repeat(<?= min(2, $gridCols) ?>, 1fr) !important;
            }
        }
        </style>
        <div id="homeInfoGrid">
            <?php foreach ($information as $index => $item): ?>
            <div class="gallery-card reveal" data-lightbox
                data-title="<?= esc($item['title']) ?>" data-desc="<?= esc($item['description'] ?? '') ?>"
                <?= $index >= 4 ? 'style="display: none;" data-hidden="true"' : '' ?>>
                <img src="<?= base_url($item['image_path']) ?>" alt="<?= esc($item['title']) ?>">
                <div class="gallery-overlay">
                    <h4><?= esc($item['title']) ?></h4>
                    <p style="font-size: 0.8rem; opacity: 0.9; margin-top: 4px;">Klik untuk memperbesar</p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="text-center" style="padding: 2rem 0; color: var(--color-dark-muted);">
            <p>Belum ada informasi yang tersedia saat ini.</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Home Gallery Upload Modal Popup -->
<div id="homeGalleryModal" class="review-modal-backdrop"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999; background: rgba(15, 23, 42, 0.65); backdrop-filter: blur(6px); align-items: center; justify-content: center; padding: 1.5rem;">
    <div class="review-modal-box"
        style="background: var(--color-white); width: 100%; max-width: 560px; border-radius: var(--border-radius-lg); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35); border: 1px solid var(--color-light-border); overflow: hidden; transform: translateY(20px); opacity: 0; transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);">
        <div
            style="background: linear-gradient(135deg, var(--color-primary-light), #ccfbf1); padding: 1.5rem; border-bottom: 1px solid rgba(10, 168, 167, 0.2); display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h3 style="font-size: 1.35rem; font-weight: 800; color: var(--color-primary-dark); margin-bottom: 4px;">
                    Kirimkan Gambar Anda</h3>
                <p style="font-size: 0.85rem; color: var(--color-dark-muted); margin: 0;">Bagikan foto momen terbaik
                    pantai yang Anda kunjungi</p>
            </div>
            <button type="button" id="btnCloseHomeGalleryModal" onclick="closeHomeGalleryModal()"
                style="background: none; border: none; font-size: 1.5rem; color: var(--color-dark-muted); cursor: pointer; padding: 4px 8px; border-radius: 6px; line-height: 1;"
                aria-label="Close modal">&times;</button>
        </div>

        <form action="<?= base_url('destinations/add-gallery-photo') ?>" method="post" enctype="multipart/form-data"
            style="padding: 1.75rem; max-height: 80vh; overflow-y: auto;">
            <?= csrf_field() ?>
            <input type="hidden" name="slug" value="home">

            <!-- Pilih Pantai -->
            <div style="margin-bottom: 1.1rem;">
                <label for="homeGalleryDest"
                    style="display: block; font-size: 0.9rem; font-weight: 700; color: var(--color-dark); margin-bottom: 6px;">Pilih
                    Pantai <span style="color: #ef4444;">*</span></label>
                <select id="homeGalleryDest" name="destination_id" required
                    style="width: 100%; padding: 11px 16px; border: 1px solid var(--color-light-border); border-radius: var(--border-radius-md); font-size: 0.95rem; background: #f8fafc; color: var(--color-dark);">
                    <?php foreach ($destinations as $dest): ?>
                    <option value="<?= esc($dest['id']) ?>"><?= esc($dest['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Nama -->
            <div style="margin-bottom: 1.1rem;">
                <label for="homeGalleryName"
                    style="display: block; font-size: 0.9rem; font-weight: 700; color: var(--color-dark); margin-bottom: 6px;">Nama
                    Lengkap <span style="color: #ef4444;">*</span></label>
                <input type="text" id="homeGalleryName" name="name" required placeholder="Masukkan nama lengkap Anda..."
                    style="width: 100%; padding: 11px 16px; border: 1px solid var(--color-light-border); border-radius: var(--border-radius-md); font-size: 0.95rem; transition: all 0.2s; background: #f8fafc;">
            </div>

            <!-- No HP -->
            <div style="margin-bottom: 1.1rem;">
                <label for="homeGalleryPhone"
                    style="display: block; font-size: 0.9rem; font-weight: 700; color: var(--color-dark); margin-bottom: 6px;">Nomor
                    HP / WhatsApp <span style="color: #ef4444;">*</span></label>
                <input type="tel" id="homeGalleryPhone" name="phone" required placeholder="Contoh: 081234567890"
                    style="width: 100%; padding: 11px 16px; border: 1px solid var(--color-light-border); border-radius: var(--border-radius-md); font-size: 0.95rem; transition: all 0.2s; background: #f8fafc;">
            </div>

            <!-- Judul Foto -->
            <div style="margin-bottom: 1.1rem;">
                <label for="homeGalleryTitle"
                    style="display: block; font-size: 0.9rem; font-weight: 700; color: var(--color-dark); margin-bottom: 6px;">Judul
                    Foto / Gambar <span style="color: #ef4444;">*</span></label>
                <input type="text" id="homeGalleryTitle" name="title" required
                    placeholder="Contoh: Senja Memukau di Pantai Matras"
                    style="width: 100%; padding: 11px 16px; border: 1px solid var(--color-light-border); border-radius: var(--border-radius-md); font-size: 0.95rem; transition: all 0.2s; background: #f8fafc;">
            </div>

            <!-- Deskripsi Foto -->
            <div style="margin-bottom: 1.25rem;">
                <label for="homeGalleryDescription"
                    style="display: block; font-size: 0.9rem; font-weight: 700; color: var(--color-dark); margin-bottom: 6px;">Deskripsi
                    Singkat <span style="color: #ef4444;">*</span></label>
                <textarea id="homeGalleryDescription" name="description" required rows="3"
                    placeholder="Ceritakan di mana foto diambil, waktu pengambilan, ataupun momen seru di baliknya..."
                    style="width: 100%; padding: 11px 16px; border: 1px solid var(--color-light-border); border-radius: var(--border-radius-md); font-size: 0.95rem; transition: all 0.2s; background: #f8fafc; font-family: inherit; resize: vertical;"></textarea>
            </div>

            <!-- Pilih Gambar (File Input) -->
            <div style="margin-bottom: 1.75rem;">
                <label
                    style="display: block; font-size: 0.9rem; font-weight: 700; color: var(--color-dark); margin-bottom: 8px;">Pilih
                    File Gambar <span style="color: #ef4444;">*</span></label>
                <div class="custom-file-dropzone"
                    style="border: 2px dashed rgba(10, 168, 167, 0.4); background: #f0fdfa; border-radius: var(--border-radius-md); padding: 1.5rem; text-align: center; cursor: pointer; transition: all 0.2s; position: relative;"
                    id="homeDropzoneArea">
                    <input type="file" id="homeGalleryPhotoInput" name="image" required
                        accept="image/jpeg,image/png,image/jpg,image/webp"
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                    <div id="homeDropzoneText">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none"
                            stroke="var(--color-primary)" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" style="margin: 0 auto 8px;">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="17 8 12 3 7 8"></polyline>
                            <line x1="12" y1="3" x2="12" y2="15"></line>
                        </svg>
                        <p style="margin: 0; font-weight: 700; color: var(--color-primary-dark); font-size: 0.95rem;">
                            Klik atau Geser File Gambar ke Sini</p>
                        <span style="font-size: 0.78rem; color: var(--color-dark-muted);">Format: JPG, PNG, atau WEBP
                            (Maksimal 10MB)</span>
                    </div>
                    <div id="homeImagePreviewBox" style="display: none; margin-top: 10px;">
                        <img id="homePreviewImageElem" src="" alt="Preview"
                            style="max-height: 160px; border-radius: 8px; box-shadow: var(--shadow-sm); margin: 0 auto; display: block;">
                        <span id="homePreviewFileName"
                            style="display: block; font-size: 0.8rem; font-weight: 600; color: var(--color-primary-dark); margin-top: 6px;"></span>
                    </div>
                </div>
            </div>

            <div style="display: flex; gap: 12px; justify-content: flex-end;">
                <button type="button" onclick="closeHomeGalleryModal()" class="btn"
                    style="padding: 12px 20px; background: #e2e8f0; color: #475569; font-weight: 700;">Batal</button>
                <button type="submit" class="btn btn-primary"
                    style="padding: 12px 28px; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, var(--color-primary), #0d9488);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                    </svg>
                    Upload & Kirim Gambar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- 4. Map Section -->
<section class="section-padding" id="map">
    <div class="container">
        <div class="map-home-grid">
            <div class="map-home-preview reveal"
                style="padding: 0; overflow: hidden; position: relative; height: 500px; border-radius: var(--border-radius-lg); box-shadow: var(--shadow-lg); border: 1px solid var(--color-light-border); background-color: var(--color-white);">
                <!-- Real interactive Leaflet/Google Maps container -->
                <div id="map-canvas" class="map-home-canvas"
                    style="width: 100%; height: 100%; min-height: 500px; z-index: 1;" data-destinations='<?= json_encode(array_map(function($d) {
                         return [
                             'id' => $d['id'],
                             'name' => $d['name'],
                             'slug' => $d['slug'],
                             'latitude' => $d['latitude'],
                             'longitude' => $d['longitude'],
                             'description' => $d['description'],
                             'baseUrl' => base_url()
                         ];
                     }, $destinations)) ?>'>
                </div>
               
            </div>

            <div class="reveal">
                <h2>Akses Mudah & Dekat dari Kota.</h2>
                <p style="margin-bottom: 2rem;">Mulai perjalanan dari Sungailiat dan jelajahi pesisir pantai sesuai
                    ritme Anda. Setiap titik lokasi menawarkan ketenangan tersendiri. Klik destinasi di bawah untuk
                    melihat lokasinya di peta.</p>

                <div class="map-home-list">
                    <?php foreach ($destinations as $dest): ?>
                    <?php
                            $distance = '';
                            if ($dest['slug'] === 'pantai-jambosag') {
                                $distance = '';
                            } elseif ($dest['slug'] === 'pantai-turun-aban') {
                                $distance = '';
                            }
                        ?>
                    <div class="map-home-item map-sidebar-card" data-id="<?= esc($dest['id']) ?>"
                        data-lat="<?= esc($dest['latitude']) ?>" data-lng="<?= esc($dest['longitude']) ?>"
                        style="cursor: pointer; transition: all 0.3s ease;">
                        <div class="map-item-left">
                            <div class="map-icon-circle">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                            </div>
                            <div class="map-item-text">
                                <h4><?= esc($dest['name']) ?></h4>
                                <p><?= esc($distance) ?></p>
                            </div>
                        </div>
                        <a href="<?= base_url('destinations/' . $dest['slug']) ?>" class="map-item-right"
                            title="Lihat Detail Pantai">
                           
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>

                <a href="https://www.google.com/maps/search/?api=1&query=Pantai+Matras+Sungailiat+Bangka"
                    target="_blank" class="btn btn-dark map-external-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                    Buka di Aplikasi Google Maps
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 5. Contact Section -->
<section class="section-padding contact-home-section" id="contact">
    <div class="container">
        <div class="contact-home-card reveal">
            <div class="contact-home-left">
                <h2 class="contact-home-title">Rencanakan Liburan Impian Anda di Bangka.</h2>
                <p class="contact-home-subtitle">Punya pertanyaan atau butuh rekomendasi wisata lokal? Kami siap
                    membantu merencanakan liburan terbaik Anda.</p>

                <!-- Flash Messages if redirected -->
                <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    <?= session()->getFlashdata('success') ?>
                </div>
                <?php endif; ?>

                <form action="<?= base_url('contact/send') ?>" method="post" class="contact-home-form">
                    <?= csrf_field() ?>
                    <div class="form-group-row">
                        <div class="form-group">
                            <label for="home-name">Nama Lengkap</label>
                            <input type="text" id="home-name" name="name" required placeholder="Nama Anda"
                                value="<?= old('name') ?>">
                        </div>
                        <div class="form-group">
                            <label for="home-phone">No. WhatsApp</label>
                            <input type="text" id="home-phone" name="phone" required placeholder="Contoh: 081234567890"
                                value="<?= old('phone') ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="home-subject">Subjek / Topik</label>
                        <input type="text" id="home-subject" name="subject" required
                            placeholder="Apa yang bisa kami bantu?" value="<?= old('subject') ?>">
                    </div>
                    <div class="form-group">
                        <label for="home-message">Isi Pesan</label>
                        <textarea id="home-message" name="message" required
                            placeholder="Tuliskan pertanyaan atau pesan Anda di sini..."><?= old('message') ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-contact-send">
                       
                        Kirim Pesan Sekarang
                    </button>
                </form>
            </div>


        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const contactForms = document.querySelectorAll('form[action$="contact/send"]');

    // Ensure showToast exists (fallback if gallery.js not loaded)
    const toastFn = typeof showToast === 'function' ? showToast : (message, type) => {
        alert(message);
    };

    contactForms.forEach(form => {
        const phoneInput = form.querySelector('input[name="phone"]');

        if (phoneInput) {
            // Auto convert 08 to +62
            phoneInput.addEventListener('input', function(e) {
                let val = this.value;
                if (val.startsWith('08')) {
                    this.value = '+628' + val.substring(2);
                }
            });
        }

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Remove existing error messages
            form.querySelectorAll('.error-message').forEach(el => el.remove());
            form.querySelectorAll('input, textarea, select').forEach(el => el.style
                .borderColor = '');

            const submitBtn = this.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;
            submitBtn.innerHTML = 'Mengirim...';
            submitBtn.disabled = true;

            const formData = new FormData(this);

            try {
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const result = await response.json();

                if (result.success) {
                    toastFn(result.message, 'success');
                    form.reset();
                } else {
                    toastFn('Terdapat kesalahan pada input Anda. Silakan periksa kembali.',
                        'error');
                    if (result.errors) {
                        for (const field in result.errors) {
                            const input = form.querySelector(`[name="${field}"]`);
                            if (input) {
                                input.style.borderColor = '#ef4444';
                                const errorMsg = document.createElement('div');
                                errorMsg.className = 'error-message';
                                errorMsg.style.color = '#ef4444';
                                errorMsg.style.fontSize = '0.8rem';
                                errorMsg.style.marginTop = '4px';
                                errorMsg.textContent = result.errors[field];
                                input.parentNode.appendChild(errorMsg);
                            }
                        }
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                toastFn('Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.',
                    'error');
            } finally {
                submitBtn.innerHTML = originalBtnText;
                submitBtn.disabled = false;
            }
        });
    });
});
</script>

<?= view('layouts/footer') ?>
<?= view('layouts/scripts') ?>