<?= $this->extend('admin/layouts/template') ?>

<?= $this->section('content') ?>

<div class="admin-card">
    <div class="admin-card-header">
        <h4>Daftar Video Shorts</h4>
        <button type="button" class="btn btn-primary btn-sm" onclick="openModal('addShortModal')">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Tambah Video
        </button>
    </div>
    
    <div class="table-responsive">
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
                        <div class="btn-group-action">
                            <button type="button" class="btn-sm btn-edit" onclick='editShort(<?= json_encode($short) ?>)' title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                            </button>
                            <a href="<?= base_url('admin/shorts/delete/'.$short['id']) ?>" class="btn-sm btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus video ini?')" title="Hapus">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                
                <?php if(empty($shorts)): ?>
                <tr>
                    <td colspan="5" class="empty-state">Belum ada video shorts yang ditambahkan.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Add/Edit Short -->
<div id="addShortModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Tambah Video Short</h3>
            <span class="close" onclick="closeModal('addShortModal')">&times;</span>
        </div>
        <div class="modal-body">
            <form id="shortForm" action="<?= base_url('admin/shorts/save') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="short_id" value="">
                
                <div class="form-group">
                    <label for="title">Judul Video <span class="text-danger">*</span></label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="youtube_url">URL YouTube <span class="text-danger">*</span></label>
                    <input type="url" id="youtube_url" name="youtube_url" class="form-control" required placeholder="https://www.youtube.com/watch?v=...">
                    <small>Masukkan URL lengkap dari YouTube.</small>
                </div>
                
                <div class="form-group mb-3">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" class="form-control" rows="4"></textarea>
                </div>
                
                <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-light" onclick="closeModal('addShortModal')">Batal</button>
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
