<?= $this->extend('admin/layouts/template') ?>

<?= $this->section('content') ?>

<style>
    .source-options {
        display: none;
    }
</style>

<div style="display: grid; grid-template-columns: 1.2fr 2fr; gap: 2rem;">
    <!-- Add Gallery Form -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h4>Tambah Cerita Galeri Visual</h4>
        </div>
        <div style="padding: 1.5rem;">
            <form action="<?= base_url('admin/gallery/save') ?>" method="POST" enctype="multipart/form-data">
                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-size: 0.88rem; font-weight: 700; margin-bottom: 6px;">Judul Cerita / Foto <span style="color: red;">*</span></label>
                    <input type="text" name="title" required placeholder="Contoh: Sunset di Batu Granit" style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1;">
                </div>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-size: 0.88rem; font-weight: 700; margin-bottom: 6px;">Destinasi Terkait</label>
                    <select name="destination_id" style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1;">
                        <option value="">-- Umum (Semua Bangka) --</option>
                        <?php foreach ($destinations as $dest): ?>
                            <option value="<?= $dest['id'] ?>"><?= esc($dest['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-size: 0.88rem; font-weight: 700; margin-bottom: 6px;">Deskripsi Singkat <span style="color: red;">*</span></label>
                    <textarea name="description" rows="3" required style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 0.9rem; line-height: 1.4;"></textarea>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-size: 0.88rem; font-weight: 700; margin-bottom: 10px;">Upload File Baru <span style="color: red;">*</span></label>
                    <input type="file" name="image" id="file_input" required accept="image/*" style="width: 100%; padding: 8px 12px; border-radius: 8px; border: 1px solid #cbd5e1; background: #f8fafc;">
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-weight: 800; border-radius: 10px;">
                    Simpan ke Visual Gallery
                </button>
            </form>
        </div>
    </div>

    <!-- Gallery Table -->
    <form method="POST" action="<?= base_url('admin/gallery/bulk-delete') ?>" id="galleryBulkForm">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <th>Preview</th>
                        <th>Judul &amp; Deskripsi</th>
                        <th>Destinasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($gallery as $item): ?>
                        <tr style="<?= $item['show_on_dashboard'] == 1 ? 'background-color: rgba(10, 168, 167, 0.05);' : '' ?>">
                            <td>
                                <input type="checkbox" name="selected_ids[]" value="<?= $item['mixed_id'] ?>" <?= $item['show_on_dashboard'] == 1 ? 'checked' : '' ?>>
                            </td>
                            <td style="width: 100px;">
                                <div style="position: relative;">
                                    <img src="<?= base_url($item['img_src']) ?>" alt="Img" style="width: 90px; height: 65px; object-fit: cover; border-radius: 8px;">
                                    <?php if ($item['source_type'] === 'user'): ?>
                                        <span style="position: absolute; top: -5px; right: 0px; background: var(--color-accent); color: white; font-size: 0.6rem; padding: 2px 4px; border-radius: 4px;">USER</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <strong style="font-size: 0.98rem; display: block; margin-bottom: 4px;"><?= esc($item['title']) ?></strong>
                                <p style="margin: 0; font-size: 0.84rem; color: #64748b; line-height: 1.4;">
                                    <?= esc($item['description']) ?>
                                </p>
                            </td>
                            <td><span class="status-badge approved"><?= esc($item['destination_name']) ?></span></td>
                            <td>
                                <a href="<?= base_url('admin/gallery/delete/' . $item['mixed_id']) ?>" class="btn-sm btn-delete" onclick="return confirm('Hapus item galeri ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div style="margin-top: 1rem; display: flex; gap: 1rem;">
    <button type="submit" formaction="<?= base_url('admin/gallery/bulk-update-dashboard') ?>" class="btn btn-primary" id="setDashboardBtn">
        <?= isset($hasDashboard) && $hasDashboard ? 'Perbarui' : 'Jadikan Gambar Gallery' ?>
    </button>
</div>
</form>
</div>

<script>
document.getElementById('setDashboardBtn').addEventListener('click', function(event) {
    const checkedCount = document.querySelectorAll('input[name="selected_ids[]"]:checked').length;
    if (checkedCount > 12) {
        event.preventDefault();
        alert('Maksimal hanya 12 gambar yang dapat ditampilkan pada Dashboard.');
    }
});
</script>

<?= $this->endSection() ?>
