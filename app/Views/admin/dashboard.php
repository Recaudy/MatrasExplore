<?= $this->extend('admin/layouts/template') ?>

<?= $this->section('content') ?>

<!-- Overview Statistics Grid -->
<div class="admin-stats-grid">
    <div class="admin-stat-card bg-gradient-blue">
        <div class="stat-info">
            <span>Total Destinasi Pantai</span>
            <h3><?= esc($stats['total_destinations']) ?></h3>
        </div>
        <div class="stat-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
        </div>
    </div>

    <div class="admin-stat-card bg-gradient-amber">
        <div class="stat-info">
            <span>Pending Review</span>
            <h3><?= esc($stats['pending_reviews']) ?></h3>
        </div>
        <div class="stat-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
        </div>
    </div>

    <div class="admin-stat-card bg-gradient-teal">
        <div class="stat-info">
            <span>Pending Foto Wisatawan</span>
            <h3><?= esc($stats['pending_photos']) ?></h3>
        </div>
        <div class="stat-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
        </div>
    </div>

    <div class="admin-stat-card bg-gradient-rose">
        <div class="stat-info">
            <span>Pesan Kontak Masuk</span>
            <h3><?= esc($stats['total_contacts']) ?></h3>
        </div>
        <div class="stat-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
        </div>
    </div>

    <div class="admin-stat-card bg-gradient-indigo">
        <div class="stat-info">
            <span>Total Pengunjung Web</span>
            <h3><?= esc($stats['total_visitors']) ?></h3>
        </div>
        <div class="stat-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
        </div>
    </div>
</div>

<!-- Moderation Grid -->
<div class="admin-grid-2">
    <!-- Pending Reviews Card -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h4>Review Menunggu Persetujuan (Pending)</h4>
            <a href="<?= base_url('admin/reviews') ?>" class="btn btn-secondary btn-sm">Lihat Semua Review</a>
        </div>
        <?php if (empty($pending_reviews)): ?>
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                <p>Tidak ada review yang menanti persetujuan. Semua aman!</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Wisatawan</th>
                            <th>Pantai</th>
                            <th>Bintang & Komentar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pending_reviews as $rev): ?>
                            <tr>
                                <td>
                                    <strong><?= esc($rev['name']) ?></strong>
                                    <br><small style="color: #64748b;"><?= esc($rev['phone']) ?></small>
                                </td>
                                <td><span class="status-badge" style="background: #e0f2fe; color: #0369a1;"><?= esc($rev['destination_name']) ?></span></td>
                                <td>
                                    <div style="color: #f59e0b; font-size: 0.95rem; margin-bottom: 4px;">
                                        <?= str_repeat('★', (int)$rev['rating']) . str_repeat('☆', 5 - (int)$rev['rating']) ?>
                                    </div>
                                    <p style="margin: 0; font-size: 0.88rem; color: #334155; line-height: 1.4; max-width: 220px;">"<?= esc($rev['comment']) ?>"</p>
                                </td>
                                <td>
                                    <div class="btn-group-action">
                                        <a href="<?= base_url('admin/reviews/approve/' . $rev['id']) ?>" class="btn-sm btn-approve" title="Setujui">Setujui</a>
                                        <a href="<?= base_url('admin/reviews/reject/' . $rev['id']) ?>" class="btn-sm btn-reject" title="Tolak">Tolak</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pending Photos Card -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h4>Foto Wisatawan Menunggu Persetujuan (Pending)</h4>
            <a href="<?= base_url('admin/photos') ?>" class="btn btn-secondary btn-sm">Lihat Semua Foto</a>
        </div>
        <?php if (empty($pending_photos)): ?>
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                <p>Tidak ada foto kontributor yang menunggu verifikasi.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Preview Foto</th>
                            <th>Detail Pengirim</th>
                            <th>Pantai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pending_photos as $photo): ?>
                            <tr>
                                <td style="width: 80px;">
                                    <img src="<?= base_url($photo['image_path']) ?>" alt="Foto" style="width: 70px; height: 50px; object-fit: cover; border-radius: 8px; box-shadow: var(--shadow-sm);">
                                </td>
                                <td>
                                    <strong style="display: block; font-size: 0.92rem;"><?= esc($photo['title']) ?></strong>
                                    <span style="font-size: 0.8rem; color: #64748b;">Oleh: <?= esc($photo['name']) ?> (<?= esc($photo['phone']) ?>)</span>
                                </td>
                                <td><span class="status-badge" style="background: #e0f2fe; color: #0369a1;"><?= esc($photo['destination_name']) ?></span></td>
                                <td>
                                    <div class="btn-group-action">
                                        <a href="<?= base_url('admin/photos/approve/' . $photo['id']) ?>" class="btn-sm btn-approve" title="Setujui">Tayangkan</a>
                                        <a href="<?= base_url('admin/photos/reject/' . $photo['id']) ?>" class="btn-sm btn-reject" title="Tolak">Tolak</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
