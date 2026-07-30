<?= $this->extend('admin/layouts/template') ?>

<?= $this->section('content') ?>

<div style="display: grid; grid-template-columns: 1fr; gap: 2rem;">
    <!-- Map Overview Card -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h4>Peta & Titik Koordinat Destinasi Pantai</h4>
            <a href="<?= base_url('admin/destinations/create') ?>" class="btn btn-primary btn-sm">+ Tambah Destinasi Pantai</a>
        </div>
        <div style="padding: 1.5rem;">
            <p style="color: #64748b; margin-bottom: 1.5rem;">
                Berikut adalah daftar titik koordinat (Latitude & Longitude) dari setiap destinasi pantai yang tampil di Google Maps & Peta Interaktif pada halaman utama website. Untuk mengubah koordinat lokasi, Anda dapat mengklik tombol <strong>Edit Koordinat</strong> pada pantai yang bersangkutan.
            </p>

            <?php if (empty($destinations)): ?>
                <div style="padding: 3rem; text-align: center; color: #64748b;">Belum ada data destinasi pantai.</div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Nama Destinasi Pantai</th>
                                <th>Lokasi Wilayah</th>
                                <th>Koordinat (Latitude / Longitude)</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($destinations as $dest): ?>
                                <tr>
                                    <td>
                                        <strong><?= esc($dest['name']) ?></strong>
                                        <br><small style="color: #64748b;"><?= esc(substr($dest['description'], 0, 70)) ?>...</small>
                                    </td>
                                    <td>
                                        <span style="font-weight: 600; color: #334155;"><?= esc($dest['location'] ?? 'Sungailiat, Bangka') ?></span>
                                    </td>
                                    <td style="font-size: 0.88rem; font-family: monospace; color: #0f172a; background: #f8fafc; padding: 10px; border-radius: 6px;">
                                        Lat: <strong><?= esc($dest['latitude']) ?></strong> <br>
                                        Lng: <strong><?= esc($dest['longitude']) ?></strong>
                                    </td>
                                    <td>
                                        <span class="status-badge <?= $dest['status'] === 'active' ? 'approved' : 'rejected' ?>">
                                            <?= $dest['status'] === 'active' ? 'Aktif di Peta' : 'Non-aktif' ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('admin/destinations/edit/' . $dest['id']) ?>" class="btn-sm btn-approve" style="display: inline-block;">Edit Koordinat</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
