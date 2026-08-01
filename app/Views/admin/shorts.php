<?= $this->extend('admin/layouts/template') ?>

<?= $this->section('content') ?>

<div class="admin-card">
    <div class="admin-card-header" style="display: flex; justify-content: space-between; align-items: center;">
        <h4 style="margin: 0; font-size: 1.1rem; color: var(--color-dark);">Daftar Video Shorts</h4>
        <button type="button" class="btn btn-primary btn-sm" onclick="openModal('addShortModal')" style="display: flex; align-items: center; gap: 0.5rem;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Tambah Video
        </button>
    </div>
    
    <div class="admin-card-body" style="overflow-x: auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">Judul</th>
                    <th width="25%">Preview</th>
                    <th width="35%">Deskripsi</th>
                    <th width="15%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach($shorts as $short): 
                    // Extract video ID from youtube url to show thumbnail
                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?|shorts)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $short['youtube_url'], $matches);
                    $youtube_id = isset($matches[1]) ? $matches[1] : '';
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><strong><?= esc($short['title']) ?></strong></td>
                    <td>
                        <?php if($youtube_id): ?>
                            <img src="https://img.youtube.com/vi/<?= $youtube_id ?>/mqdefault.jpg" alt="<?= esc($short['title']) ?>" style="width: 150px; border-radius: 8px;">
                        <?php else: ?>
                            <span class="text-muted">URL tidak valid</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <p style="margin: 0; font-size: 0.9rem; color: #64748b; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; word-break: break-word; overflow-wrap: anywhere;">
                            <?= esc($short['description']) ?>
                        </p>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button type="button" class="btn btn-secondary btn-sm" onclick='editShort(<?= json_encode($short) ?>)' style="background: #e2e8f0; color: #475569; border: none;" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                            </button>
                            <a href="<?= base_url('admin/shorts/delete/'.$short['id']) ?>" class="btn btn-secondary btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus video ini?')" style="background: #fee2e2; color: #ef4444; border: none;" title="Hapus">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                
                <?php if(empty($shorts)): ?>
                <tr>
                    <td colspan="5" class="text-center" style="padding: 2rem;">Belum ada video shorts yang ditambahkan.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Add/Edit Short -->
<div id="addShortModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5);">
    <div class="modal-content" style="background-color: #fff; margin: 10% auto; padding: 0; border: none; border-radius: 12px; width: 90%; max-width: 500px; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
        <div class="modal-header" style="padding: 1rem 1.5rem; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
            <h3 id="modalTitle" style="margin: 0; font-size: 1.25rem;">Tambah Video Short</h3>
            <span class="close" onclick="closeModal('addShortModal')" style="color: #94a3b8; font-size: 1.5rem; font-weight: bold; cursor: pointer;">&times;</span>
        </div>
        <div class="modal-body" style="padding: 1.5rem;">
            <form id="shortForm" action="<?= base_url('admin/shorts/save') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="short_id" value="">
                
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="title" style="display: block; margin-bottom: 0.5rem; font-weight: 500; font-size: 0.95rem;">Judul Video <span class="text-danger">*</span></label>
                    <input type="text" id="title" name="title" class="form-control" required style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 8px;">
                </div>
                
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="youtube_url" style="display: block; margin-bottom: 0.5rem; font-weight: 500; font-size: 0.95rem;">URL YouTube <span class="text-danger">*</span></label>
                    <input type="url" id="youtube_url" name="youtube_url" class="form-control" required placeholder="https://www.youtube.com/watch?v=..." style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 8px;">
                    <small style="color: #64748b; display: block; margin-top: 0.25rem;">Masukkan URL lengkap dari YouTube.</small>
                </div>
                
                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label for="description" style="display: block; margin-bottom: 0.5rem; font-weight: 500; font-size: 0.95rem;">Deskripsi</label>
                    <textarea id="description" name="description" class="form-control" rows="4" style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 8px; resize: vertical;"></textarea>
                </div>
                
                <div style="display: flex; justify-content: flex-end; gap: 0.5rem;">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('addShortModal')" style="background: #f1f5f9; color: #475569; border: none;">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Video</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openModal(id) {
    document.getElementById('modalTitle').innerText = 'Tambah Video Short';
    document.getElementById('short_id').value = '';
    document.getElementById('shortForm').reset();
    document.getElementById(id).style.display = 'block';
}

function closeModal(id) {
    document.getElementById(id).style.display = 'none';
}

function editShort(short) {
    document.getElementById('modalTitle').innerText = 'Edit Video Short';
    document.getElementById('short_id').value = short.id;
    document.getElementById('title').value = short.title;
    document.getElementById('youtube_url').value = short.youtube_url;
    document.getElementById('description').value = short.description;
    document.getElementById('addShortModal').style.display = 'block';
}

// Close modal when clicking outside of it
window.onclick = function(event) {
    var modal = document.getElementById('addShortModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<?= $this->endSection() ?>
