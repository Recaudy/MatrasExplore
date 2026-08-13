<?= $this->extend('admin/layouts/template') ?>

<?= $this->section('content') ?>
<div class="admin-content-inner">
    <div class="admin-card">
        <div class="admin-card-header">
            <h4>Edit Berita</h4>
            <a href="<?= base_url('admin/news') ?>" class="btn btn-light btn-sm">Kembali</a>
        </div>
        
        <form action="<?= base_url('admin/news/update/' . $news['id']) ?>" method="post" enctype="multipart/form-data" style="padding: 1.5rem;">
            <?= csrf_field() ?>
            
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.95rem; font-weight: 600; color: var(--color-dark); margin-bottom: 8px;">Judul Berita <span style="color: red;">*</span></label>
                <input type="text" name="title" required value="<?= esc(old('title', $news['title'])) ?>" style="width: 100%; padding: 12px 16px; border: 1px solid var(--color-light-border); border-radius: var(--border-radius-md); font-size: 1rem; background: #f8fafc; outline: none;">
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.95rem; font-weight: 600; color: var(--color-dark); margin-bottom: 8px;">Isi Berita <span style="color: red;">*</span></label>
                <textarea name="content" id="news-editor" style="display: none;"><?= esc(old('content', $news['content'])) ?></textarea>
                <p style="font-size: 0.85rem; color: var(--color-dark-muted); margin-top: 6px;">Anda dapat mengatur format teks (Tebal, Miring, List, dll) menggunakan toolbar di atas.</p>
            </div>

            <div style="margin-bottom: 2rem;">
                <label style="display: block; font-size: 0.95rem; font-weight: 600; color: var(--color-dark); margin-bottom: 8px;">Tambah Foto Baru</label>
                <input type="file" name="images[]" multiple accept="image/*" style="width: 100%; padding: 10px; border: 1px dashed var(--color-primary); border-radius: var(--border-radius-md); background: #f0fdfa;">
                <p style="font-size: 0.85rem; color: var(--color-dark-muted); margin-top: 6px;">Foto yang diupload di sini akan ditambahkan ke daftar foto di bawah.</p>
            </div>

            <div style="display: flex; gap: 12px; justify-content: flex-end; border-top: 1px solid var(--admin-border); padding-top: 1.5rem;">
                <button type="submit" class="btn btn-primary" style="padding: 10px 24px; font-size: 1rem;">Perbarui Berita</button>
            </div>
        </form>
    </div>

    <!-- Foto Manager -->
    <div class="admin-card" style="margin-top: 2rem;">
        <div class="admin-card-header">
            <h4>Manajemen Foto Berita</h4>
        </div>
        <div style="padding: 1.5rem;">
            <?php if (empty($images)): ?>
                <p style="text-align: center; color: var(--color-dark-muted); padding: 2rem;">Belum ada foto untuk berita ini.</p>
            <?php else: ?>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem;">
                    <?php foreach ($images as $img): ?>
                        <div style="border: 1px solid var(--color-light-border); border-radius: 8px; overflow: hidden; position: relative;">
                            <img src="<?= base_url($img['image_path']) ?>" alt="Foto Berita" style="width: 100%; height: 150px; object-fit: cover; display: block;">
                            <?php if ($img['is_main']): ?>
                                <div style="position: absolute; top: 8px; left: 8px; background: var(--color-primary); color: white; padding: 4px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: bold; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                                    FOTO UTAMA
                                </div>
                            <?php endif; ?>
                            
                            <div style="padding: 10px; background: #f8fafc; display: flex; justify-content: space-between; border-top: 1px solid var(--color-light-border);">
                                <?php if (!$img['is_main']): ?>
                                    <a href="<?= base_url('admin/news/set-main-image/' . $news['id'] . '/' . $img['id']) ?>" class="btn-sm btn-approve" style="font-size: 0.75rem; padding: 4px 8px;">Jadikan Utama</a>
                                <?php else: ?>
                                    <span style="font-size: 0.75rem; color: var(--color-dark-muted); padding: 4px 8px;">Sudah Utama</span>
                                <?php endif; ?>
                                
                                <a href="<?= base_url('admin/news/delete-image/' . $img['id']) ?>" class="btn-sm btn-delete" style="font-size: 0.75rem; padding: 4px 8px;" onclick="return confirm('Hapus foto ini secara permanen?')">Hapus</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/super-build/ckeditor.js"></script>
<script>
    CKEDITOR.ClassicEditor.create(document.querySelector('#news-editor'), {
        toolbar: {
            items: [
                'heading', '|',
                'fontSize', 'fontFamily', '|',
                'bold', 'italic', 'underline', 'link', '|',
                'alignment', '|',
                'bulletedList', 'numberedList', '|',
                'outdent', 'indent', '|',
                'blockQuote', 'insertTable', 'undo', 'redo'
            ],
            shouldNotGroupWhenFull: true
        },
        removePlugins: [
            'CKBox', 'CKFinder', 'EasyImage', 'RealTimeCollaborativeComments', 'RealTimeCollaborativeTrackChanges', 'RealTimeCollaborativeRevisionHistory',
            'PresenceList', 'Comments', 'TrackChanges', 'TrackChangesData', 'RevisionHistory', 'Pagination', 'WProofreader', 'MathType',
            'SlashCommand', 'Template', 'DocumentOutline', 'FormatPainter', 'TableOfContents', 'PasteFromOfficeEnhanced'
        ]
    })
    .catch(error => {
        console.error(error);
    });
</script>
<style>
    .ck-editor__editable {
        min-height: 250px;
    }
</style>
<?= $this->endSection() ?>
