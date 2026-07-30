<?= $this->extend('admin/layouts/template') ?>

<?= $this->section('content') ?>

<div class="admin-card">
    <div class="admin-card-header">
        <h4>Kelola Data Destinasi Pantai</h4>
        <a href="<?= base_url('admin/destinations/create') ?>" class="btn btn-primary btn-sm" style="background: linear-gradient(135deg, var(--color-primary), #0d9488);">
            + Tambah Destinasi Baru
        </a>
    </div>
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Cover</th>
                    <th>Nama Destinasi</th>
                    <th>Tiket Masuk</th>
                    <th>Jam Buka</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($destinations as $dest): ?>
                    <tr>
                        <td style="width: 90px;">
                            <img src="<?= base_url($dest['image']) ?>" alt="<?= esc($dest['name']) ?>" style="width: 80px; height: 55px; object-fit: cover; border-radius: 8px;">
                        </td>
                        <td>
                            <strong style="font-size: 1rem; color: var(--color-dark);"><?= esc($dest['name']) ?></strong>
                            <br><small style="color: #64748b;"><?= esc($dest['location']) ?></small>
                        </td>
                        <td><strong style="color: var(--color-primary);"><?= $dest['ticket_price'] > 0 ? 'Rp ' . number_format($dest['ticket_price'], 0, ',', '.') : 'Gratis' ?></strong></td>
                        <td><?= esc($dest['opening_hours']) ?></td>
                        <td><span class="status-badge <?= $dest['status'] === 'active' ? 'approved' : 'pending' ?>"><?= esc($dest['status']) ?></span></td>
                        <td>
                            <div class="btn-group-action">
                                <a href="<?= base_url('admin/destinations/edit/' . $dest['id']) ?>" class="btn-sm btn-edit">Edit</a>
                                <a href="<?= base_url('admin/destinations/delete/' . $dest['id']) ?>" class="btn-sm btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus destinasi pantai ini?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
