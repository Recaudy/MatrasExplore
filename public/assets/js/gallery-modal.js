/* Gallery Upload Modal, File Preview, and Photo Detail Lightbox JS */

document.addEventListener('DOMContentLoaded', () => {
    // -----------------------------------------------------------
    // 1. Upload Gallery Modal
    // -----------------------------------------------------------
    const uploadModal = document.getElementById('galleryModal');
    const btnOpenUpload = document.getElementById('btnOpenGalleryModal');
    const btnCloseUpload = document.getElementById('btnCloseGalleryModal');
    const btnCancelUpload = document.getElementById('btnCancelGalleryModal');
    
    // File input elements
    const fileInput = document.getElementById('galleryPhotoInput');
    const dropzoneText = document.getElementById('dropzoneText');
    const previewBox = document.getElementById('imagePreviewBox');
    const previewImg = document.getElementById('previewImageElem');
    const previewName = document.getElementById('previewFileName');

    if (uploadModal && btnOpenUpload) {
        btnOpenUpload.addEventListener('click', () => {
            uploadModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        const closeUploadModal = () => {
            uploadModal.classList.remove('active');
            document.body.style.overflow = '';
        };

        if (btnCloseUpload) btnCloseUpload.addEventListener('click', closeUploadModal);
        if (btnCancelUpload) btnCancelUpload.addEventListener('click', closeUploadModal);

        uploadModal.addEventListener('click', (e) => {
            if (e.target === uploadModal) closeUploadModal();
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && uploadModal.classList.contains('active')) {
                closeUploadModal();
            }
        });
    }

    // Image File Preview
    if (fileInput && previewImg) {
        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                if (!file.type.startsWith('image/')) {
                    alert('Harap pilih file dengan format gambar (JPG, PNG, atau WEBP).');
                    fileInput.value = '';
                    return;
                }
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 5MB.');
                    fileInput.value = '';
                    return;
                }
                const reader = new FileReader();
                reader.onload = function(event) {
                    previewImg.src = event.target.result;
                    if (dropzoneText) dropzoneText.style.display = 'none';
                    if (previewBox) previewBox.style.display = 'block';
                    
                    const sizeMB = (file.size / (1024 * 1024)).toFixed(2);
                    if (previewName) previewName.textContent = `${file.name} (${sizeMB} MB)`;
                };
                reader.readAsDataURL(file);
            } else {
                if (dropzoneText) dropzoneText.style.display = 'block';
                if (previewBox) previewBox.style.display = 'none';
            }
        });
    }

    // -----------------------------------------------------------
    // 2. Photo Detail Lightbox Modal (Click on Photo Tile)
    // -----------------------------------------------------------
    const detailModal = document.getElementById('photoDetailModal');
    const btnCloseDetail = document.getElementById('btnClosePhotoDetailModal');
    const btnCloseBottom = document.getElementById('btnCloseBottomPhotoDetail');
    const photoTiles = document.querySelectorAll('.user-photo-card');

    if (detailModal && photoTiles.length > 0) {
        const lightboxImg = document.getElementById('lightboxImg');
        const lightboxTitle = document.getElementById('lightboxTitle');
        const lightboxName = document.getElementById('lightboxName');
        const lightboxAvatar = document.getElementById('lightboxAvatar');
        const lightboxDesc = document.getElementById('lightboxDesc');
        const lightboxDate = document.getElementById('lightboxDate');

        const closeDetailModal = () => {
            detailModal.classList.remove('active');
            document.body.style.overflow = '';
        };

        if (btnCloseDetail) btnCloseDetail.addEventListener('click', closeDetailModal);
        if (btnCloseBottom) btnCloseBottom.addEventListener('click', closeDetailModal);

        detailModal.addEventListener('click', (e) => {
            if (e.target === detailModal) closeDetailModal();
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && detailModal.classList.contains('active')) {
                closeDetailModal();
            }
        });

        // Note: The photo detail modal click listener was removed because
        // we are now using the shared gallery lightbox from gallery.js
        // for .user-photo-card elements.
    }
});
