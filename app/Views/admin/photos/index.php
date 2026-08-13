<?= $this->extend('admin/layouts/template') ?>

<?= $this->section('content') ?>

<div class="admin-card">
    <div class="admin-card-header">
        <h4>Moderasi Foto Galeri Kiriman Wisatawan</h4>
        <div class="d-flex gap-2">
            <a href="<?= base_url('admin/photos?status=pending') ?>" class="btn-sm <?= $status === 'pending' ? 'btn-warning' : 'btn-light' ?>">Pending (Menunggu)</a>
            <a href="<?= base_url('admin/photos?status=approved') ?>" class="btn-sm <?= $status === 'approved' ? 'btn-success' : 'btn-light' ?>">Approved (Tayang)</a>
            <a href="<?= base_url('admin/photos?status=rejected') ?>" class="btn-sm <?= $status === 'rejected' ? 'btn-danger' : 'btn-light' ?>">Rejected (Ditolak)</a>
            <a href="<?= base_url('admin/photos?status=all') ?>" class="btn-sm <?= $status === 'all' ? 'btn-primary' : 'btn-light' ?>">Semua</a>
        </div>
    </div>

    <?php if (empty($photos)): ?>
        <div class="empty-state">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
            <p>Tidak ada kiriman foto dengan filter status "<?= esc(strtoupper($status)) ?>" saat ini.</p>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Preview Foto</th>
                        <th>Status</th>
                        <th>Destinasi Pantai</th>
                        <th>Judul & Deskripsi Foto</th>
                        <th>Kontributor</th>
                        <th>Waktu</th>
                        <th>Moderasi / Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($photos as $photo): ?>
                        <tr>
                            <td style="width: 110px;">
                                <a href="<?= base_url($photo['image_path']) ?>" target="_blank" title="Klik untuk lihat ukuran asli">
                                    <img src="<?= base_url($photo['image_path']) ?>" alt="Foto" style="width: 100px; height: 75px; object-fit: cover; border-radius: 10px; box-shadow: var(--shadow-sm); border: 2px solid white;">
                                </a>
                            </td>
                            <td>
                                <span class="status-badge <?= esc($photo['status']) ?>">
                                    <?= strtoupper(esc($photo['status'])) ?>
                                </span>
                            </td>
                            <td><strong class="text-primary-dark"><?= esc($photo['destination_name']) ?></strong></td>
                            <td style="max-width: 260px;">
                                <strong class="d-block mb-1 font-bold" style="font-size: 1rem; color: var(--color-dark);"><?= esc($photo['title']) ?></strong>
                                <p class="mb-0 text-muted" style="font-size: 0.85rem; line-height: 1.4;"><?= esc($photo['description']) ?></p>
                            </td>
                            <td>
                                <strong><?= esc($photo['name']) ?></strong>
                                <br><small class="text-muted"><?= esc($photo['phone']) ?></small>
                            </td>
                            <td class="text-muted" style="font-size: 0.82rem;"><?= date('d M Y H:i', strtotime($photo['created_at'])) ?></td>
                            <td>
                                <div class="btn-group-action">
                                    <?php if ($photo['status'] !== 'approved'): ?>
                                        <a href="<?= base_url('admin/photos/approve/' . $photo['id']) ?>" class="btn-sm btn-approve" title="Setujui agar tampil di galeri">Setujui</a>
                                    <?php endif; ?>
                                    
                                    <?php if ($photo['status'] !== 'rejected'): ?>
                                        <a href="<?= base_url('admin/photos/reject/' . $photo['id']) ?>" class="btn-sm btn-reject" title="Tolak foto">Tolak</a>
                                    <?php endif; ?>

                                    <a href="<?= base_url('admin/photos/delete/' . $photo['id']) ?>" class="btn-sm btn-delete" onclick="return confirm('Hapus permanen foto ini?')" title="Hapus Permanen">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
