<?= $this->extend('admin/layouts/template') ?>

<?= $this->section('content') ?>
<div class="admin-content-inner">
    <!-- Data Table -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h4>Manajemen Informasi</h4>
            <button type="button" class="btn btn-primary btn-sm" onclick="openAddModal()">
                + Tambah Informasi
            </button>
        </div>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th width="80">Gambar</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th width="120" style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($information)): ?>
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 3rem 1rem; color: var(--color-dark-muted);">Belum ada data informasi.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($information as $item): ?>
                            <tr>
                                <td>
                                    <img src="<?= base_url($item['image_path']) ?>" alt="Preview" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid var(--color-light-border);">
                                </td>
                                <td>
                                    <strong><?= esc($item['title']) ?></strong>
                                </td>
                                <td>
                                    <div style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-size: 0.9rem; color: var(--color-dark-muted);">
                                        <?= esc($item['description']) ?>
                                    </div>
                                </td>
                                <td style="text-align: right;">
                                    <div style="display: flex; gap: 8px; justify-content: flex-end;">
                                        <button type="button" class="btn btn-sm btn-edit" 
                                                onclick="openEditModal(<?= $item['id'] ?>, '<?= htmlspecialchars(addslashes($item['title'])) ?>', '<?= htmlspecialchars(addslashes($item['description'] ?? '')) ?>')">
                                            Edit
                                        </button>
                                        <a href="<?= base_url('admin/information/delete/' . $item['id']) ?>" 
                                           class="btn btn-sm btn-delete" 
                                           onclick="return confirm('Hapus informasi ini secara permanen?')">
                                            Hapus
                                        </a>
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

<!-- Modal Dialog -->
<div id="infoModal" class="review-modal-backdrop" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999; background: rgba(15, 23, 42, 0.65); backdrop-filter: blur(6px); align-items: center; justify-content: center; padding: 1.5rem;">
    <div class="review-modal-box" style="background: var(--color-white); width: 100%; max-width: 500px; border-radius: var(--border-radius-lg); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35); border: 1px solid var(--color-light-border); overflow: hidden;">
        <div style="background: linear-gradient(135deg, var(--color-primary-light), #ccfbf1); padding: 1.25rem 1.5rem; border-bottom: 1px solid rgba(10, 168, 167, 0.2); display: flex; justify-content: space-between; align-items: center;">
            <h3 id="modalTitle" style="font-size: 1.25rem; font-weight: 700; color: var(--color-primary-dark); margin: 0;">Tambah Informasi</h3>
            <button type="button" onclick="closeModal()" style="background: none; border: none; font-size: 1.5rem; color: var(--color-dark-muted); cursor: pointer; padding: 4px;">&times;</button>
        </div>

        <form id="infoForm" action="<?= base_url('admin/information/save') ?>" method="post" enctype="multipart/form-data" style="padding: 1.5rem;">
            <?= csrf_field() ?>
            <input type="hidden" name="id" id="info_id">

            <div style="margin-bottom: 1rem;">
                <label style="display: block; font-size: 0.9rem; font-weight: 600; color: var(--color-dark); margin-bottom: 6px;">Judul <span style="color: red;">*</span></label>
                <input type="text" name="title" id="info_title" required class="admin-input">
            </div>

            <div style="margin-bottom: 1rem;">
                <label style="display: block; font-size: 0.9rem; font-weight: 600; color: var(--color-dark); margin-bottom: 6px;">Deskripsi</label>
                <textarea name="description" id="info_description" rows="3" class="admin-input"></textarea>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.9rem; font-weight: 600; color: var(--color-dark); margin-bottom: 6px;">Gambar Poster <span id="img_req" style="color: red;">*</span></label>
                <input type="file" name="image" id="info_image" accept="image/*" class="admin-input" style="padding: 8px;">
                <p id="img_help" style="font-size: 0.8rem; color: var(--color-dark-muted); margin-top: 4px;">Pilih gambar untuk diupload.</p>
            </div>

            <div style="display: flex; gap: 12px; justify-content: flex-end;">
                <button type="button" onclick="closeModal()" class="btn" style="background: #e2e8f0; color: #475569;">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<style>
    .admin-input {
        width: 100%; padding: 10px 14px; border: 1px solid var(--color-light-border); border-radius: var(--border-radius-md); font-size: 0.95rem; background: #f8fafc;
    }
</style>

<script>
    function openAddModal() {
        document.getElementById('modalTitle').innerText = 'Tambah Informasi Baru';
        document.getElementById('infoForm').reset();
        document.getElementById('info_id').value = '';
        document.getElementById('info_image').required = true;
        document.getElementById('img_req').style.display = 'inline';
        document.getElementById('img_help').innerText = 'Pilih gambar untuk diupload.';
        
        document.getElementById('infoModal').style.display = 'flex';
        // Add a slight delay for animation effect
        setTimeout(() => {
            document.querySelector('#infoModal .review-modal-box').style.opacity = '1';
            document.querySelector('#infoModal .review-modal-box').style.transform = 'translateY(0)';
        }, 10);
    }

    function openEditModal(id, title, desc) {
        document.getElementById('modalTitle').innerText = 'Edit Informasi';
        document.getElementById('info_id').value = id;
        document.getElementById('info_title').value = title;
        document.getElementById('info_description').value = desc;
        
        document.getElementById('info_image').required = false;
        document.getElementById('img_req').style.display = 'none';
        document.getElementById('img_help').innerText = 'Biarkan kosong jika tidak ingin mengganti gambar.';

        document.getElementById('infoModal').style.display = 'flex';
        setTimeout(() => {
            document.querySelector('#infoModal .review-modal-box').style.opacity = '1';
            document.querySelector('#infoModal .review-modal-box').style.transform = 'translateY(0)';
        }, 10);
    }

    function closeModal() {
        document.querySelector('#infoModal .review-modal-box').style.opacity = '0';
        document.querySelector('#infoModal .review-modal-box').style.transform = 'translateY(20px)';
        setTimeout(() => {
            document.getElementById('infoModal').style.display = 'none';
        }, 300);
    }
</script>
<?= $this->endSection() ?>
