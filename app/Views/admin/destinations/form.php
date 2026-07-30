<?= $this->extend('admin/layouts/template') ?>

<?= $this->section('content') ?>

<style>
    .form-group-custom { margin-bottom: 1.5rem; }
    .form-group-custom label {
        display: block;
        font-weight: 700;
        font-size: 0.9rem;
        color: var(--color-dark);
        margin-bottom: 8px;
    }
    .form-control-custom {
        width: 100%;
        padding: 14px 16px;
        background: #f8fafc;
        border-radius: 12px;
        border: 1.5px solid #e2e8f0;
        font-size: 0.95rem;
        color: var(--color-dark);
        transition: all 0.3s ease;
        font-family: inherit;
    }
    .form-control-custom:focus {
        outline: none;
        background: #ffffff;
        border-color: var(--color-primary);
        box-shadow: 0 0 0 4px rgba(10, 168, 167, 0.15);
    }
    .file-upload-wrapper {
        position: relative;
        overflow: hidden;
        display: block;
        width: 100%;
        margin-bottom: 1rem;
    }
    .file-upload-input {
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        cursor: pointer;
        height: 100%;
        width: 100%;
        z-index: 10;
    }
    .file-upload-ui {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 2.5rem 1rem;
        background: #f8fafc;
        border: 2px dashed #cbd5e1;
        border-radius: 16px;
        text-align: center;
        transition: all 0.3s ease;
    }
    .file-upload-wrapper:hover .file-upload-ui {
        border-color: var(--color-primary);
        background: #f0fbfb;
    }
    .file-icon {
        background: white;
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: var(--shadow-sm);
        margin-bottom: 1rem;
        color: var(--color-primary);
    }
    .facility-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 12px;
    }
    .facility-card {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s ease;
        font-weight: 600;
        font-size: 0.95rem;
    }
    .facility-card:hover, .facility-card:has(input:checked) {
        border-color: var(--color-primary);
        background: #f0fbfb;
    }
    .facility-card input[type="checkbox"] {
        width: 20px;
        height: 20px;
        accent-color: var(--color-primary);
        cursor: pointer;
    }
    .image-preview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }
    .preview-item {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        aspect-ratio: 4/3;
        border: 2px solid #e2e8f0;
    }
    .preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .section-title {
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--color-dark);
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .admin-card-premium {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 15px 35px -10px rgba(0,0,0,0.05), 0 5px 15px rgba(0,0,0,0.03);
        border: 1px solid #f1f5f9;
        overflow: hidden;
    }
    .admin-card-header-premium {
        background: linear-gradient(135deg, #0f172a, #1e293b);
        padding: 2rem;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .admin-card-header-premium h4 {
        margin: 0;
        font-size: 1.5rem;
        color: white;
        font-family: var(--font-heading);
    }
    .form-body {
        padding: 2.5rem;
    }
    .two-col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }
    @media (max-width: 768px) {
        .two-col { grid-template-columns: 1fr; }
    }
</style>

<div class="admin-card-premium" style="max-width: 1000px; margin: 0 auto;">
    <div class="admin-card-header-premium">
        <h4><?= $destination ? 'Edit Destinasi: ' . esc($destination['name']) : 'Tambah Destinasi Pantai Baru' ?></h4>
        <a href="<?= base_url('admin/destinations') ?>" class="btn btn-secondary" style="background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.2); border-radius: 12px; padding: 10px 20px;">&larr; Kembali</a>
    </div>
    
    <div class="form-body">
        <form action="<?= base_url($destination ? 'admin/destinations/update/' . $destination['id'] : 'admin/destinations/save') ?>" method="POST" enctype="multipart/form-data">
            
            <div class="section-title">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                Informasi Umum
            </div>
            
            <div class="two-col">
                <div class="form-group-custom">
                    <label>Nama Destinasi Pantai <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="name" class="form-control-custom" value="<?= esc($destination['name'] ?? '') ?>" required placeholder="Contoh: Pantai Matras">
                </div>
                <div class="form-group-custom">
                    <label>Lokasi / Wilayah</label>
                    <input type="text" name="location" class="form-control-custom" value="<?= esc($destination['location'] ?? 'Sungailiat, Bangka') ?>" required placeholder="Contoh: Sungailiat, Bangka">
                </div>
            </div>

            <div class="form-group-custom">
                <label>Ringkasan / Overview Pantai <span style="color: #ef4444;">*</span></label>
                <textarea name="description" class="form-control-custom" rows="4" required placeholder="Deskripsikan keindahan dan daya tarik utama pantai ini..."><?= esc($destination['description'] ?? '') ?></textarea>
            </div>

            <div class="form-group-custom">
                <label>Sejarah & Keunikan (History & Heritage) <span style="color: #ef4444;">*</span></label>
                <textarea name="history" class="form-control-custom" rows="4" required placeholder="Ceritakan sejarah singkat atau fakta unik tentang pantai ini..."><?= esc($destination['history'] ?? '') ?></textarea>
            </div>

            <div class="section-title" style="margin-top: 2.5rem;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                Detail Operasional & Peta
            </div>

            <div class="two-col" style="grid-template-columns: 1fr 1fr 1fr;">
                <div class="form-group-custom">
                    <label>Harga Tiket (Rp)</label>
                    <input type="number" name="ticket_price" class="form-control-custom" value="<?= esc($destination['ticket_price'] ?? '10000') ?>" required>
                </div>
                <div class="form-group-custom">
                    <label>Jam Buka</label>
                    <input type="text" name="opening_hours" class="form-control-custom" value="<?= esc($destination['opening_hours'] ?? '06:00 - 18:00') ?>" required>
                </div>
                <div class="form-group-custom">
                    <label>Status</label>
                    <select name="status" class="form-control-custom">
                        <option value="active" <?= ($destination['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active (Tayang)</option>
                        <option value="inactive" <?= ($destination['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive (Sembunyikan)</option>
                    </select>
                </div>
            </div>

            <div class="two-col">
                <div class="form-group-custom">
                    <label>Latitude (Koordinat Peta)</label>
                    <input type="text" name="latitude" class="form-control-custom" value="<?= esc($destination['latitude'] ?? '-1.61208000') ?>" required>
                </div>
                <div class="form-group-custom">
                    <label>Longitude (Koordinat Peta)</label>
                    <input type="text" name="longitude" class="form-control-custom" value="<?= esc($destination['longitude'] ?? '105.78912000') ?>" required>
                </div>
            </div>

            <div class="section-title" style="margin-top: 2.5rem;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                Fasilitas Tersedia
            </div>

            <div class="form-group-custom">
                <div class="facility-grid">
                    <?php if(!empty($all_facilities)): foreach($all_facilities as $fac): ?>
                        <label class="facility-card">
                            <input type="checkbox" name="facilities[]" value="<?= $fac['id'] ?>" 
                                <?= in_array($fac['id'], $dest_facilities ?? []) ? 'checked' : '' ?>>
                            <span class="material-icons" style="font-size: 1.25rem; color: var(--color-primary);"><?= esc($fac['icon']) ?></span>
                            <?= esc($fac['name']) ?>
                        </label>
                    <?php endforeach; endif; ?>
                </div>
            </div>

            <div class="section-title" style="margin-top: 3rem;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                Media & Foto
            </div>

            <div class="form-group-custom">
                <label>Foto Cover Utama (Main Image)</label>
                
                <div class="file-upload-wrapper">
                    <input type="file" name="main_image" class="file-upload-input" accept="image/*" onchange="previewMainImage(this)">
                    <div class="file-upload-ui">
                        <div class="file-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                        </div>
                        <h5 style="margin: 0 0 8px; font-weight: 700; color: var(--color-dark); font-size: 1.05rem;">Tarik & Lepas Foto Cover ke Sini</h5>
                        <p style="margin: 0; color: #64748b; font-size: 0.9rem;">atau klik untuk memilih file dari perangkat Anda</p>
                    </div>
                </div>

                <div id="main-image-preview-container">
                    <?php if ($destination && !empty($destination['images'])): ?>
                        <div class="preview-item" style="width: 200px; aspect-ratio: 16/9; margin-top: 1rem;">
                            <img src="<?= base_url($destination['images'][0]['image']) ?>" alt="Cover Saat Ini">
                            <div style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.6); color: white; font-size: 0.75rem; padding: 4px; text-align: center; font-weight: 600;">Cover Saat Ini</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group-custom" style="margin-top: 2rem;">
                <label>Galeri Foto Resmi (Bisa pilih lebih dari 1 file)</label>
                
                <div class="file-upload-wrapper">
                    <input type="file" name="gallery_images[]" class="file-upload-input" accept="image/*" multiple onchange="previewGalleryImages(this)">
                    <div class="file-upload-ui">
                        <div class="file-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                        </div>
                        <h5 style="margin: 0 0 8px; font-weight: 700; color: var(--color-dark); font-size: 1.05rem;">Pilih Banyak Foto Sekaligus</h5>
                        <p style="margin: 0; color: #64748b; font-size: 0.9rem;">Foto-foto ini akan ditambahkan ke bagian galeri destinasi (tanpa menghapus foto sebelumnya)</p>
                    </div>
                </div>

                <!-- Live Preview untuk upload foto baru -->
                <div id="new-gallery-preview" class="image-preview-grid"></div>

                <!-- Foto Galeri Sebelumnya (Hanya Muncul Saat Mode Edit) -->
                <?php if ($destination && !empty($destination['images'])): ?>
                    <label style="margin-top: 2rem; border-top: 1px solid #e2e8f0; padding-top: 1.5rem;">Foto Galeri Saat Ini</label>
                    <div class="image-preview-grid">
                        <?php foreach($destination['images'] as $img): ?>
                            <div class="preview-item">
                                <img src="<?= base_url($img['image']) ?>" alt="Gallery">
                                <a href="<?= base_url('admin/destinations/delete-image/' . $img['id']) ?>" onclick="return confirm('Yakin ingin menghapus foto ini?')" style="position: absolute; top: 8px; right: 8px; background: rgba(239, 68, 68, 0.95); color: white; border-radius: 50%; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: bold; text-decoration: none; cursor: pointer; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: transform 0.2s;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div style="display: flex; justify-content: flex-end; margin-top: 3rem; padding-top: 1.5rem; border-top: 2px solid #f1f5f9;">
                <button type="submit" class="btn btn-primary" style="padding: 14px 40px; font-weight: 800; font-size: 1.05rem; border-radius: 14px; box-shadow: 0 8px 20px -6px rgba(10, 168, 167, 0.5);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                    <?= $destination ? 'Simpan Perubahan' : 'Tambah Destinasi Baru' ?>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewMainImage(input) {
    const container = document.getElementById('main-image-preview-container');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            container.innerHTML = `
                <div class="preview-item" style="width: 200px; aspect-ratio: 16/9; margin-top: 1rem; border-color: var(--color-primary);">
                    <img src="${e.target.result}" alt="Preview">
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(10, 168, 167, 0.9); color: white; font-size: 0.75rem; padding: 4px; text-align: center; font-weight: 700;">File Terpilih</div>
                </div>
            `;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function previewGalleryImages(input) {
    const container = document.getElementById('new-gallery-preview');
    container.innerHTML = ''; 
    
    if (input.files) {
        // Tambahkan label jika ada file
        if (input.files.length > 0) {
            const label = document.createElement('label');
            label.style = "grid-column: 1 / -1; margin-top: 1rem; color: var(--color-primary);";
            label.innerHTML = `<strong>${input.files.length} Foto Baru Terpilih:</strong>`;
            container.appendChild(label);
        }

        Array.from(input.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'preview-item';
                div.style.borderColor = 'var(--color-primary)';
                div.innerHTML = `
                    <img src="${e.target.result}" alt="Preview">
                    <div style="position: absolute; top: 0; left: 0; right: 0; background: linear-gradient(180deg, rgba(0,0,0,0.6) 0%, transparent 100%); padding: 12px 8px; color: white; font-size: 0.7rem; font-weight: 600; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">
                        ${file.name}
                    </div>
                `;
                container.appendChild(div);
            }
            reader.readAsDataURL(file);
        });
    }
}
</script>

<?= $this->endSection() ?>
