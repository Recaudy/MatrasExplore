<?= $this->extend('admin/layouts/template') ?>

<?= $this->section('content') ?>

<div class="admin-card">
    <div class="admin-card-header">
        <h4>Pengaturan Kontak & Pusat Informasi</h4>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div style="background-color: #d1fae5; color: #065f46; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-weight: 600;">
            ✅ <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('admin/settings/update') ?>" method="post">
        <?= csrf_field() ?>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
            <div>
                <label style="display: block; font-weight: 700; margin-bottom: 8px;">Telepon / WhatsApp</label>
                <input type="text" name="contact_phone" value="<?= esc($settings['contact_phone'] ?? '') ?>" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px;">
            </div>
            <div>
                <label style="display: block; font-weight: 700; margin-bottom: 8px;">Email</label>
                <input type="email" name="contact_email" value="<?= esc($settings['contact_email'] ?? '') ?>" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px;">
            </div>
            <div>
                <label style="display: block; font-weight: 700; margin-bottom: 8px;">Jam Operasional</label>
                <input type="text" name="contact_hours" value="<?= esc($settings['contact_hours'] ?? '') ?>" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px;">
            </div>
        </div>

        <div style="margin-bottom: 2rem;">
            <label style="display: block; font-weight: 700; margin-bottom: 8px;">Alamat Pusat Informasi</label>
            <textarea name="contact_address" rows="3" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; resize: vertical;"><?= esc($settings['contact_address'] ?? '') ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
    </form>
</div>

<?= $this->endSection() ?>
