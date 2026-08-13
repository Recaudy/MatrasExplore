<?= $this->extend('admin/layouts/template') ?>

<?= $this->section('content') ?>

<div class="admin-card">
    <div class="admin-card-header">
        <h4>Pengaturan Kontak & Pusat Informasi</h4>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert-success">
            ✅ <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('admin/settings/update') ?>" method="post">
        <?= csrf_field() ?>
        
        <div class="admin-grid-half mb-3">
            <div class="form-group">
                <label>Telepon / WhatsApp</label>
                <input type="text" name="contact_phone" value="<?= esc($settings['contact_phone'] ?? '') ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="contact_email" value="<?= esc($settings['contact_email'] ?? '') ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Jam Operasional</label>
                <input type="text" name="contact_hours" value="<?= esc($settings['contact_hours'] ?? '') ?>" class="form-control" required>
            </div>
        </div>

        <div class="form-group mb-4">
            <label>Alamat Pusat Informasi</label>
            <textarea name="contact_address" rows="3" class="form-control" required><?= esc($settings['contact_address'] ?? '') ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
    </form>
</div>

<?= $this->endSection() ?>
