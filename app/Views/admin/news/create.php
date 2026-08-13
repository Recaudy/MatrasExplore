<?= $this->extend('admin/layouts/template') ?>

<?= $this->section('content') ?>
<div class="admin-content-inner">
    <div class="admin-card">
        <div class="admin-card-header">
            <h4>Tambah Berita Baru</h4>
            <a href="<?= base_url('admin/news') ?>" class="btn btn-light btn-sm">Kembali</a>
        </div>
        
        <form action="<?= base_url('admin/news/save') ?>" method="post" enctype="multipart/form-data" style="padding: 1.5rem;">
            <?= csrf_field() ?>
            
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.95rem; font-weight: 600; color: var(--color-dark); margin-bottom: 8px;">Judul Berita <span style="color: red;">*</span></label>
                <input type="text" name="title" required value="<?= old('title') ?>" style="width: 100%; padding: 12px 16px; border: 1px solid var(--color-light-border); border-radius: var(--border-radius-md); font-size: 1rem; background: #f8fafc; outline: none;">
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.95rem; font-weight: 600; color: var(--color-dark); margin-bottom: 8px;">Isi Berita <span style="color: red;">*</span></label>
                <textarea name="content" id="news-editor" style="display: none;"><?= old('content') ?></textarea>
                <p style="font-size: 0.85rem; color: var(--color-dark-muted); margin-top: 6px;">Anda dapat mengatur format teks (Tebal, Miring, List, dll) menggunakan toolbar di atas.</p>
            </div>

            <div style="margin-bottom: 2rem;">
                <label style="display: block; font-size: 0.95rem; font-weight: 600; color: var(--color-dark); margin-bottom: 8px;">Foto Berita</label>
                <input type="file" name="images[]" multiple accept="image/*" style="width: 100%; padding: 10px; border: 1px dashed var(--color-primary); border-radius: var(--border-radius-md); background: #f0fdfa;">
                <p style="font-size: 0.85rem; color: var(--color-dark-muted); margin-top: 6px;">Anda dapat memilih lebih dari satu foto sekaligus. Foto pertama akan otomatis menjadi foto utama.</p>
            </div>

            <div style="display: flex; gap: 12px; justify-content: flex-end; border-top: 1px solid var(--admin-border); padding-top: 1.5rem;">
                <button type="submit" class="btn btn-primary" style="padding: 10px 24px; font-size: 1rem;">Simpan Berita</button>
            </div>
        </form>
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
