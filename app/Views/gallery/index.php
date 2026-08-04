<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>

<!-- Gallery Header -->
<section class="page-header">
    <div class="container text-center">
        <?php if (session()->getFlashdata('gallery_success')): ?>
            <div style="background: #dcfce7; border: 1px solid #22c55e; color: #15803d; padding: 16px; border-radius: var(--border-radius-md); margin-bottom: 2rem; font-weight: 700; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 4px 12px rgba(34, 197, 94, 0.15); text-align: left;">
                <span style="display: flex; align-items: center; gap: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    <?= esc(session()->getFlashdata('gallery_success')) ?>
                </span>
                <button type="button" onclick="this.parentElement.style.display='none'" style="background: none; border: none; font-size: 1.3rem; cursor: pointer; color: #15803d;">&times;</button>
            </div>
        <?php endif; ?>

        <h1 style="margin-bottom: 1rem;">Galeri Pesona Pantai & Kiriman Pengguna</h1>
        <p class="page-header-desc">Kumpulan potret pesona pantai dari Explore Bangka serta kiriman foto dari para pengunjung setia</p>
        <div style="margin-top: 1.5rem;">
            <button type="button" class="btn btn-primary" onclick="openHomeGalleryModal()" style="display: inline-flex; align-items: center; gap: 8px; font-weight: 700; padding: 12px 24px; box-shadow: var(--shadow-md);">
                 Kirimkan Gambar
            </button>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <?php if (empty($gallery)): ?>
            <div class="text-center" style="padding: 3rem 0; color: var(--color-dark-muted);">
                <p>Belum ada foto galeri yang tersedia.</p>
            </div>
        <?php else: ?>
            <style>
                @media (max-width: 992px) {
                    #galleryPageGrid {
                        display: grid !important;
                        grid-template-columns: repeat(2, 1fr) !important;
                        gap: 20px !important;
                    }
                    #galleryPageGrid .gallery-page-card {
                        border-radius: var(--border-radius-lg) !important;
                        overflow: hidden !important;
                        height: auto !important;
                        width: 100% !important;
                        aspect-ratio: 1 / 1 !important;
                    }
                }
            </style>
            <div class="gallery-page-grid" id="galleryPageGrid">
                <?php foreach ($gallery as $index => $item): ?>
                    <div class="gallery-card gallery-page-card reveal" 
                         data-lightbox 
                         data-title="<?= esc($item['title']) ?>" 
                         data-desc="<?= esc($item['description']) ?>"
                         <?= $index >= 8 ? 'style="display: none;" data-hidden="true"' : '' ?>>
                        <img src="<?= base_url($item['image_path'] ?? $item['image']) ?>" alt="<?= esc($item['title']) ?>">
                        <div class="gallery-overlay" style="padding: 1.25rem; background: linear-gradient(to top, rgba(15, 23, 42, 0.85) 0%, rgba(15, 23, 42, 0.15) 50%, transparent 100%);">
                            <span style="color: #fff; font-weight: 700; font-size: 1.05rem; line-height: 1.3; margin-bottom: 4px; text-shadow: 0 2px 4px rgba(0,0,0,0.5); display: block;"><?= esc($item['title']) ?></span>
                            <?php if ($item['type'] === 'user'): ?>
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
                <button id="btnLoadMoreGalleryPage" class="btn btn-outline-primary" style="font-weight: 700; padding: 12px 32px; border-radius: 50px;">
                    Tampilkan Lebih Banyak
                </button>
            </div>
            
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const btnLoadMore = document.getElementById('btnLoadMoreGalleryPage');
                if (btnLoadMore) {
                    btnLoadMore.addEventListener('click', function() {
                        const hiddenItems = document.querySelectorAll('#galleryPageGrid .gallery-page-card[data-hidden="true"]');
                        const itemsToShow = 8;
                        
                        if (hiddenItems.length === 0) {
                            btnLoadMore.style.display = 'none';
                            return;
                        }
                        
                        for (let i = 0; i < itemsToShow && i < hiddenItems.length; i++) {
                            hiddenItems[i].style.display = 'block';
                            hiddenItems[i].removeAttribute('data-hidden');
                            
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
        <?php endif; ?>
    </div>
</section>

<!-- Home Gallery Upload Modal Popup -->
<div id="homeGalleryModal" class="review-modal-backdrop" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999; background: rgba(15, 23, 42, 0.65); backdrop-filter: blur(6px); align-items: center; justify-content: center; padding: 1.5rem;">
    <div class="review-modal-box" style="background: var(--color-white); width: 100%; max-width: 560px; border-radius: var(--border-radius-lg); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35); border: 1px solid var(--color-light-border); overflow: hidden; transform: translateY(20px); opacity: 0; transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);">
        <div style="background: linear-gradient(135deg, var(--color-primary-light), #ccfbf1); padding: 1.5rem; border-bottom: 1px solid rgba(10, 168, 167, 0.2); display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h3 style="font-size: 1.35rem; font-weight: 800; color: var(--color-primary-dark); margin-bottom: 4px;">Kirimkan Gambar Anda</h3>
                <p style="font-size: 0.85rem; color: var(--color-dark-muted); margin: 0;">Bagikan foto momen terbaik pantai yang Anda kunjungi</p>
            </div>
            <button type="button" id="btnCloseHomeGalleryModal" onclick="closeHomeGalleryModal()" style="background: none; border: none; font-size: 1.5rem; color: var(--color-dark-muted); cursor: pointer; padding: 4px 8px; border-radius: 6px; line-height: 1;" aria-label="Close modal">&times;</button>
        </div>

        <form action="<?= base_url('destinations/add-gallery-photo') ?>" method="post" enctype="multipart/form-data" style="padding: 1.75rem; max-height: 80vh; overflow-y: auto;">
            <?= csrf_field() ?>
            <input type="hidden" name="slug" value="home">

            <!-- Pilih Pantai -->
            <div style="margin-bottom: 1.1rem;">
                <label for="homeGalleryDest" style="display: block; font-size: 0.9rem; font-weight: 700; color: var(--color-dark); margin-bottom: 6px;">Pilih Pantai <span style="color: #ef4444;">*</span></label>
                <select id="homeGalleryDest" name="destination_id" required style="width: 100%; padding: 11px 16px; border: 1px solid var(--color-light-border); border-radius: var(--border-radius-md); font-size: 0.95rem; background: #f8fafc; color: var(--color-dark);">
                    <?php if (!empty($destinations)): foreach ($destinations as $dest): ?>
                        <option value="<?= esc($dest['id']) ?>"><?= esc($dest['name']) ?></option>
                    <?php endforeach; endif; ?>
                </select>
            </div>

            <!-- Nama -->
            <div style="margin-bottom: 1.1rem;">
                <label for="homeGalleryName" style="display: block; font-size: 0.9rem; font-weight: 700; color: var(--color-dark); margin-bottom: 6px;">Nama Lengkap <span style="color: #ef4444;">*</span></label>
                <input type="text" id="homeGalleryName" name="name" required placeholder="Masukkan nama lengkap Anda..." style="width: 100%; padding: 11px 16px; border: 1px solid var(--color-light-border); border-radius: var(--border-radius-md); font-size: 0.95rem; transition: all 0.2s; background: #f8fafc;">
            </div>

            <!-- No HP -->
            <div style="margin-bottom: 1.1rem;">
                <label for="homeGalleryPhone" style="display: block; font-size: 0.9rem; font-weight: 700; color: var(--color-dark); margin-bottom: 6px;">Nomor HP / WhatsApp <span style="color: #ef4444;">*</span></label>
                <input type="tel" id="homeGalleryPhone" name="phone" required placeholder="Contoh: 081234567890" style="width: 100%; padding: 11px 16px; border: 1px solid var(--color-light-border); border-radius: var(--border-radius-md); font-size: 0.95rem; transition: all 0.2s; background: #f8fafc;">
            </div>

            <!-- Judul Foto -->
            <div style="margin-bottom: 1.1rem;">
                <label for="homeGalleryTitle" style="display: block; font-size: 0.9rem; font-weight: 700; color: var(--color-dark); margin-bottom: 6px;">Judul Foto / Gambar <span style="color: #ef4444;">*</span></label>
                <input type="text" id="homeGalleryTitle" name="title" required maxlength="50" placeholder="Contoh: Senja Memukau di Pantai Matras" style="width: 100%; padding: 11px 16px; border: 1px solid var(--color-light-border); border-radius: var(--border-radius-md); font-size: 0.95rem; transition: all 0.2s; background: #f8fafc;">
            </div>

            <!-- Deskripsi Foto -->
            <div style="margin-bottom: 1.25rem;">
                <label for="homeGalleryDescription" style="display: block; font-size: 0.9rem; font-weight: 700; color: var(--color-dark); margin-bottom: 6px;">Deskripsi Singkat <span style="color: #ef4444;">*</span></label>
                <textarea id="homeGalleryDescription" name="description" required maxlength="200" rows="3" placeholder="Ceritakan di mana foto diambil, waktu pengambilan, ataupun momen seru di baliknya..." style="width: 100%; padding: 11px 16px; border: 1px solid var(--color-light-border); border-radius: var(--border-radius-md); font-size: 0.95rem; transition: all 0.2s; background: #f8fafc; font-family: inherit; resize: vertical;"></textarea>
            </div>

            <!-- Pilih Gambar (File Input) -->
            <div style="margin-bottom: 1.75rem;">
                <label style="display: block; font-size: 0.9rem; font-weight: 700; color: var(--color-dark); margin-bottom: 8px;">Pilih File Gambar <span style="color: #ef4444;">*</span></label>
                <div class="custom-file-dropzone" style="border: 2px dashed rgba(10, 168, 167, 0.4); background: #f0fdfa; border-radius: var(--border-radius-md); padding: 1.5rem; text-align: center; cursor: pointer; transition: all 0.2s; position: relative;" id="homeDropzoneArea">
                    <input type="file" id="homeGalleryPhotoInput" name="image" required accept="image/jpeg,image/png,image/jpg,image/webp" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                    <div id="homeDropzoneText">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 8px;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                        <p style="margin: 0; font-weight: 700; color: var(--color-primary-dark); font-size: 0.95rem;">Klik atau Geser File Gambar ke Sini</p>
                        <span style="font-size: 0.78rem; color: var(--color-dark-muted);">Format: JPG, PNG, atau WEBP (Maksimal 2MB)</span>
                    </div>
                    <div id="homeImagePreviewBox" style="display: none; margin-top: 10px;">
                        <img id="homePreviewImageElem" src="" alt="Preview" style="max-height: 160px; border-radius: 8px; box-shadow: var(--shadow-sm); margin: 0 auto; display: block;">
                        <span id="homePreviewFileName" style="display: block; font-size: 0.8rem; font-weight: 600; color: var(--color-primary-dark); margin-top: 6px;"></span>
                    </div>
                </div>
            </div>

            <div style="display: flex; gap: 12px; justify-content: flex-end;">
                <button type="button" onclick="closeHomeGalleryModal()" class="btn" style="padding: 12px 20px; background: #e2e8f0; color: #475569; font-weight: 700;">Batal</button>
                <button type="submit" class="btn btn-primary" style="padding: 12px 28px; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, var(--color-primary), #0d9488);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                    Upload & Kirim Gambar
                </button>
            </div>
        </form>
    </div>
</div>

<?= view('layouts/footer') ?>
<?= view('layouts/scripts') ?>
