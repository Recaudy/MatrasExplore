<?= $this->extend('admin/layouts/template') ?>

<?= $this->section('content') ?>

<div class="admin-card" style="max-width: 860px;">
    <div class="admin-card-header">
        <h4>Kelola Tampilan Hero Section (Halaman Depan Website)</h4>
    </div>
    <div style="padding: 2rem;">
        <form action="<?= base_url('admin/hero/update') ?>" method="POST" enctype="multipart/form-data">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 700; font-size: 0.88rem; margin-bottom: 8px;">Badge / Label Atas</label>
                    <input type="text" name="hero_badge" value="<?= esc($settings['hero_badge'] ?? 'EXCITING BANGKA ISLAND') ?>" style="width: 100%; padding: 12px 16px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 0.95rem;">
                </div>
                <div>
                    <label style="display: block; font-weight: 700; font-size: 0.88rem; margin-bottom: 8px;">Gambar Latar Belakang (Background)</label>
                    <input type="file" name="hero_bg_image" accept="image/*" style="width: 100%; padding: 9px 16px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 0.9rem; background: #f8fafc;">
                    <span style="font-size: 0.78rem; color: #64748b; margin-top: 4px; display: block;">Biarkan kosong jika tidak ingin mengubah background saat ini.</span>
                </div>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 700; font-size: 0.88rem; margin-bottom: 8px;">Judul Utama (Hero Title)</label>
                <input type="text" name="hero_title" value="<?= esc($settings['hero_title'] ?? 'Discover the Untamed Beauty of Matras') ?>" required style="width: 100%; padding: 12px 16px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 1.05rem; font-weight: 700;">
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 700; font-size: 0.88rem; margin-bottom: 8px;">Deskripsi Singkat (Hero Subtitle)</label>
                <textarea name="hero_subtitle" rows="3" required style="width: 100%; padding: 12px 16px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 0.95rem; line-height: 1.5;"><?= esc($settings['hero_subtitle'] ?? 'Immerse yourself in crystal-clear waters, ancient granite formations, and tranquil coastal sanctuaries. Your next great escape begins here.') ?></textarea>
            </div>

            <div style="border-top: 1px solid #e2e8f0; pt-4; margin-top: 1.5rem; padding-top: 1.5rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div style="background: #f8fafc; padding: 1.25rem; border-radius: 12px; border: 1px solid #e2e8f0;">
                    <h5 style="margin: 0 0 12px; font-size: 0.95rem; font-weight: 800; color: var(--color-primary-dark);">Pengaturan Tombol 1 (Utama)</h5>
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; font-size: 0.82rem; font-weight: 700; margin-bottom: 6px;">Teks Tombol</label>
                        <input type="text" name="hero_btn1_text" value="<?= esc($settings['hero_btn1_text'] ?? 'Explore Beaches') ?>" style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.82rem; font-weight: 700; margin-bottom: 6px;">URL Tujuan</label>
                        <input type="text" name="hero_btn1_url" value="<?= esc($settings['hero_btn1_url'] ?? 'destinations') ?>" style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1;">
                    </div>
                </div>

                <div style="background: #f8fafc; padding: 1.25rem; border-radius: 12px; border: 1px solid #e2e8f0;">
                    <h5 style="margin: 0 0 12px; font-size: 0.95rem; font-weight: 800; color: #475569;">Pengaturan Tombol 2 (Sekunder)</h5>
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; font-size: 0.82rem; font-weight: 700; margin-bottom: 6px;">Teks Tombol</label>
                        <input type="text" name="hero_btn2_text" value="<?= esc($settings['hero_btn2_text'] ?? 'View Map') ?>" style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.82rem; font-weight: 700; margin-bottom: 6px;">URL Tujuan</label>
                        <input type="text" name="hero_btn2_url" value="<?= esc($settings['hero_btn2_url'] ?? 'map') ?>" style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1;">
                    </div>
                </div>
            </div>

            <div style="margin-top: 2rem; display: flex; justify-content: flex-end;">
                <button type="submit" class="btn btn-primary" style="padding: 12px 32px; font-weight: 800; border-radius: 12px;">
                    Simpan Perubahan Hero
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
