<?= $this->extend('admin/layouts/template') ?>

<?= $this->section('content') ?>

<div class="admin-card">
    <div class="admin-card-header">
        <h4>Kotak Masuk Pesan Kontak (Contact Messages Inbox)</h4>
    </div>

    <?php if (empty($messages)): ?>
        <div class="empty-state">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
            <p>Belum ada pesan masuk dari pengunjung saat ini.</p>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Pengirim</th>
                        <th>No. WhatsApp</th>
                        <th>Subjek / Topik</th>
                        <th>Isi Pesan</th>
                        <th>Waktu Dikirim</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $msg): ?>
                        <tr>
                            <td><strong><?= esc($msg['name']) ?></strong></td>
                            <td><a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', esc($msg['phone'])) ?>" target="_blank" class="text-success font-semibold" style="text-decoration: none;">💬 <?= esc($msg['phone']) ?></a></td>
                            <td><strong style="color: var(--color-dark);"><?= esc($msg['subject']) ?></strong></td>
                            <td class="text-muted" style="max-width: 340px; line-height: 1.5;"><?= nl2br(esc($msg['message'])) ?></td>
                            <td class="text-muted" style="font-size: 0.82rem;"><?= date('d M Y H:i', strtotime($msg['created_at'])) ?></td>
                            <td>
                                <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', esc($msg['phone'])) ?>" target="_blank" class="btn-sm btn-success mb-1 d-inline-block">Balas via WA</a>
                                <a href="<?= base_url('admin/contacts/delete/' . $msg['id']) ?>" class="btn-sm btn-delete" onclick="return confirm('Hapus pesan kontak ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
