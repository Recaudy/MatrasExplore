<?= $this->extend('admin/layouts/template') ?>

<?= $this->section('content') ?>
<div class="admin-content-inner">
    <div class="admin-card">
        <div class="admin-card-header">
            <h4>Manajemen Berita</h4>
            <a href="<?= base_url('admin/news/create') ?>" class="btn btn-primary btn-sm">
                + Tulis Berita
            </a>
        </div>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Judul Berita</th>
                        <th>Tanggal Dibuat</th>
                        <th width="150" style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($news)): ?>
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 3rem 1rem; color: var(--color-dark-muted);">Belum ada berita.</td>
                        </tr>
                    <?php else: ?>
                        <?php $i = 1; foreach ($news as $item): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td>
                                    <strong><?= esc($item['title']) ?></strong>
                                </td>
                                <td><?= date('d M Y H:i', strtotime($item['created_at'])) ?></td>
                                <td style="text-align: right;">
                                    <div style="display: flex; gap: 8px; justify-content: flex-end;">
                                        <a href="<?= base_url('admin/news/edit/' . $item['id']) ?>" class="btn btn-sm btn-edit">Edit</a>
                                        <a href="<?= base_url('admin/news/delete/' . $item['id']) ?>" class="btn btn-sm btn-delete" onclick="return confirm('Hapus berita ini secara permanen?')">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
