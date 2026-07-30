<?= $this->extend('admin/layouts/template') ?>

<?= $this->section('content') ?>

<div class="admin-card">
    <div class="admin-card-header">
        <h4>Moderasi Review & Rating Wisatawan</h4>
        <div style="display: flex; gap: 8px;">
            <a href="<?= base_url('admin/reviews?status=pending') ?>" class="btn-sm <?= $status === 'pending' ? 'btn-approve' : 'btn-secondary' ?>" style="<?= $status !== 'pending' ? 'background: #f1f5f9; color: #334155;' : '' ?>">Pending (Menunggu)</a>
            <a href="<?= base_url('admin/reviews?status=approved') ?>" class="btn-sm <?= $status === 'approved' ? 'btn-approve' : 'btn-secondary' ?>" style="<?= $status !== 'approved' ? 'background: #f1f5f9; color: #334155;' : '' ?>">Approved (Tayang)</a>
            <a href="<?= base_url('admin/reviews?status=rejected') ?>" class="btn-sm <?= $status === 'rejected' ? 'btn-reject' : 'btn-secondary' ?>" style="<?= $status !== 'rejected' ? 'background: #f1f5f9; color: #334155;' : '' ?>">Rejected (Ditolak)</a>
            <a href="<?= base_url('admin/reviews?status=all') ?>" class="btn-sm <?= $status === 'all' ? 'btn-edit' : 'btn-secondary' ?>" style="<?= $status !== 'all' ? 'background: #f1f5f9; color: #334155;' : '' ?>">Semua</a>
        </div>
    </div>

    <?php if (empty($reviews)): ?>
        <div style="padding: 3rem; text-align: center; color: #64748b;">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 10px display: block;"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
            <p style="margin: 0; font-weight: 600; font-size: 1.05rem;">Tidak ada review dengan filter status "<?= esc(strtoupper($status)) ?>" saat ini.</p>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Destinasi Pantai</th>
                        <th>Pengirim</th>
                        <th>Rating</th>
                        <th>Isi Komentar Review</th>
                        <th>Waktu</th>
                        <th>Moderasi / Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reviews as $rev): ?>
                        <tr>
                            <td>
                                <span class="status-badge <?= esc($rev['status']) ?>">
                                    <?= strtoupper(esc($rev['status'])) ?>
                                </span>
                            </td>
                            <td><strong style="color: var(--color-primary-dark);"><?= esc($rev['destination_name']) ?></strong></td>
                            <td>
                                <strong><?= esc($rev['name']) ?></strong>
                                <br><small style="color: #64748b;"><?= esc($rev['phone']) ?></small>
                            </td>
                            <td>
                                <div style="color: #f59e0b; font-size: 1.05rem; letter-spacing: 1px;">
                                    <?= str_repeat('★', (int)$rev['rating']) . str_repeat('☆', 5 - (int)$rev['rating']) ?>
                                </div>
                                <span style="font-size: 0.78rem; font-weight: 700; color: #64748b;"><?= $rev['rating'] ?> / 5</span>
                            </td>
                            <td style="max-width: 280px; line-height: 1.5;">"<?= esc($rev['comment']) ?>"</td>
                            <td style="font-size: 0.82rem; color: #64748b;"><?= date('d M Y H:i', strtotime($rev['created_at'])) ?></td>
                            <td>
                                <div class="btn-group-action">
                                    <?php if ($rev['status'] !== 'approved'): ?>
                                        <a href="<?= base_url('admin/reviews/approve/' . $rev['id']) ?>" class="btn-sm btn-approve" title="Setujui agar tampil di website">Setujui</a>
                                    <?php endif; ?>
                                    
                                    <?php if ($rev['status'] !== 'rejected'): ?>
                                        <a href="<?= base_url('admin/reviews/reject/' . $rev['id']) ?>" class="btn-sm btn-reject" title="Tolak review">Tolak</a>
                                    <?php endif; ?>

                                    <a href="<?= base_url('admin/reviews/delete/' . $rev['id']) ?>" class="btn-sm btn-delete" onclick="return confirm('Hapus permanen review dari <?= esc($rev['name']) ?>?')" title="Hapus Permanen">Hapus</a>
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
