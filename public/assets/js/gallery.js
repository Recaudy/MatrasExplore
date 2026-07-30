/* Explore Bangka Beaches - Gallery & Slideshow Script */

document.addEventListener('DOMContentLoaded', () => {
    // ----------------------------------------------------
    // 1. LIGHTBOX MODAL HANDLER (For gallery sections)
    // ----------------------------------------------------
    const galleryCards = document.querySelectorAll('.gallery-card[data-lightbox], .user-photo-card[data-lightbox]');
    
    if (galleryCards.length > 0) {
        // Create lightbox modal elements dynamically if they don't exist
        let modal = document.getElementById('lightbox-modal');
        if (!modal) {
            modal = document.createElement('div');
            modal.id = 'lightbox-modal';
            modal.className = 'lightbox-modal';
            modal.innerHTML = `
                <button class="lightbox-close" id="lightbox-close" aria-label="Close">&times;</button>
                <div class="lightbox-content">
                    <img id="lightbox-img" src="" alt="Gallery Image">
                    <div class="lightbox-nav">
                        <button class="lightbox-arrow" id="lightbox-prev" aria-label="Previous">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                        </button>
                        <button class="lightbox-arrow" id="lightbox-next" aria-label="Next">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="lightbox-caption">
                    <h4 id="lightbox-title"></h4>
                    <p id="lightbox-desc"></p>
                </div>
            `;
            document.body.appendChild(modal);
        }
        
        const imgEl = document.getElementById('lightbox-img');
        const titleEl = document.getElementById('lightbox-title');
        const descEl = document.getElementById('lightbox-desc');
        const closeBtn = document.getElementById('lightbox-close');
        const prevBtn = document.getElementById('lightbox-prev');
        const nextBtn = document.getElementById('lightbox-next');
        
        let currentIndex = 0;
        const galleryData = Array.from(galleryCards).map((card, idx) => {
            let desc = card.getAttribute('data-desc') || card.querySelector('.gallery-overlay p')?.textContent || '';
            const author = card.getAttribute('data-name');
            if (author) {
                desc += ` (Foto kiriman dari ${author})`;
            }
            return {
                index: idx,
                src: card.querySelector('img').src,
                title: card.getAttribute('data-title') || card.querySelector('h4')?.textContent || '',
                desc: desc
            };
        });
        
        const openLightbox = (index) => {
            currentIndex = index;
            const data = galleryData[currentIndex];
            
            imgEl.src = data.src;
            titleEl.textContent = data.title;
            descEl.textContent = data.desc;
            
            modal.classList.add('active');
            document.body.style.overflow = 'hidden'; // Stop background scroll
        };
        
        const closeLightbox = () => {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        };
        
        const showNext = () => {
            let nextIdx = currentIndex + 1;
            if (nextIdx >= galleryData.length) nextIdx = 0;
            openLightbox(nextIdx);
        };
        
        const showPrev = () => {
            let prevIdx = currentIndex - 1;
            if (prevIdx < 0) prevIdx = galleryData.length - 1;
            openLightbox(prevIdx);
        };
        
        // Bind click events on gallery cards
        galleryCards.forEach((card, index) => {
            card.addEventListener('click', (e) => {
                e.preventDefault();
                openLightbox(index);
            });
        });
        
        // Bind control buttons
        closeBtn.addEventListener('click', closeLightbox);
        nextBtn.addEventListener('click', showNext);
        prevBtn.addEventListener('click', showPrev);
        
        // Close on clicking overlay black area
        modal.addEventListener('click', (e) => {
            if (e.target === modal || e.target.classList.contains('lightbox-content')) {
                closeLightbox();
            }
        });
        
        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (!modal.classList.contains('active')) return;
            
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowRight') showNext();
            if (e.key === 'ArrowLeft') showPrev();
        });
    }

    // ----------------------------------------------------
    // 2. SLIDESHOW THUMBNAIL HANDLER (For detail page)
    // ----------------------------------------------------
    const thumbs = document.querySelectorAll('.slideshow-thumb');
    const mainImg = document.getElementById('main-slide-img');
    
    if (thumbs.length > 0 && mainImg) {
        thumbs.forEach(thumb => {
            thumb.addEventListener('click', function() {
                const newSrc = this.getAttribute('data-src');
                if (newSrc) {
                    mainImg.src = newSrc;
                    thumbs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                }
            });
        });
    }
});

// Home Gallery Upload Modal Functions
function openHomeGalleryModal() {
    const modal = document.getElementById('homeGalleryModal');
    if (modal) {
        modal.style.display = 'flex';
        setTimeout(() => {
            const box = modal.querySelector('.review-modal-box');
            if (box) {
                box.style.transform = 'translateY(0)';
                box.style.opacity = '1';
            }
        }, 10);
        document.body.style.overflow = 'hidden';
    }
}

function closeHomeGalleryModal() {
    const modal = document.getElementById('homeGalleryModal');
    if (modal) {
        const box = modal.querySelector('.review-modal-box');
        if (box) {
            box.style.transform = 'translateY(20px)';
            box.style.opacity = '0';
        }
        setTimeout(() => {
            modal.style.display = 'none';
            document.body.style.overflow = '';
        }, 250);
    }
}

// ----------------------------------------------------
// 3. AJAX FORM SUBMISSION FOR GALLERY UPLOADS
// ----------------------------------------------------
const uploadForms = document.querySelectorAll('form[action*="add-gallery-photo"]');

const showToast = (message, type = 'success') => {
    const toast = document.createElement('div');
    toast.style.position = 'fixed';
    toast.style.bottom = '20px';
    toast.style.right = '20px';
    toast.style.minWidth = '250px';
    toast.style.padding = '12px 20px';
    toast.style.borderRadius = '8px';
    toast.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
    toast.style.zIndex = '10000';
    toast.style.display = 'flex';
    toast.style.alignItems = 'center';
    toast.style.gap = '8px';
    toast.style.background = type === 'success' ? '#dcfce7' : '#fef2f2';
    toast.style.color = type === 'success' ? '#15803d' : '#b91c1c';
    toast.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        <span>${message}</span>
        <button style="background:none;border:none;color:inherit;font-size:1.2rem;cursor:pointer;" onclick="this.parentElement.remove()">&times;</button>
    `;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 5000);
};

uploadForms.forEach(form => {
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        // Remove existing error messages
        form.querySelectorAll('.error-message').forEach(el => el.remove());
        form.querySelectorAll('input, textarea, select').forEach(el => el.style.borderColor = 'var(--color-light-border)');

        const formData = new FormData(form);
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        const result = await response.json();
        
        if (result.status === 'success') {
            showToast(result.message, 'success');
            // Reset form and preview
            form.reset();
            const previewBox = form.querySelector('#homeImagePreviewBox') || form.querySelector('#imagePreviewBox');
            const dropzoneText = form.querySelector('#homeDropzoneText') || form.querySelector('#dropzoneText');
            if(previewBox) previewBox.style.display = 'none';
            if(dropzoneText) dropzoneText.style.display = 'block';
            
            // Close modal if present
            const modal = form.closest('.review-modal-backdrop');
            if (modal) {
                if (modal.id === 'homeGalleryModal' && typeof closeHomeGalleryModal === 'function') {
                    closeHomeGalleryModal();
                } else {
                    modal.classList.remove('active');
                    document.body.style.overflow = '';
                }
            }

        } else if (result.status === 'error') {
            if (result.errors && typeof result.errors === 'object') {
                for (const field in result.errors) {
                    const input = form.querySelector(`[name="${field}"]`);
                    if (input) {
                        input.style.borderColor = '#ef4444';
                        const errorMsg = document.createElement('div');
                        errorMsg.className = 'error-message';
                        errorMsg.style.color = '#ef4444';
                        errorMsg.style.fontSize = '0.8rem';
                        errorMsg.style.marginTop = '4px';
                        errorMsg.textContent = result.errors[field];
                        input.parentNode.appendChild(errorMsg);
                    }
                }
                showToast('Terdapat kesalahan pada form. Silakan periksa kembali isian Anda.', 'error');
            } else {
                showToast(result.message || 'Terjadi kesalahan saat mengupload.', 'error');
            }
        }
    });
});

// Setup image preview for home dropzone
const homeFileInput = document.getElementById('homeGalleryPhotoInput');
const homePreviewBox = document.getElementById('homeImagePreviewBox');
const homePreviewImg = document.getElementById('homePreviewImageElem');
const homeDropzoneText = document.getElementById('homeDropzoneText');
const homePreviewName = document.getElementById('homePreviewFileName');

if (homeFileInput && homePreviewImg) {
    homeFileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            if (!file.type.startsWith('image/')) {
                alert('Harap pilih file dengan format gambar (JPG, PNG, atau WEBP).');
                homeFileInput.value = '';
                return;
            }
            if (file.size > 10 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 10MB.');
                homeFileInput.value = '';
                return;
            }
            const reader = new FileReader();
            reader.onload = function(event) {
                homePreviewImg.src = event.target.result;
                if (homeDropzoneText) homeDropzoneText.style.display = 'none';
                if (homePreviewBox) homePreviewBox.style.display = 'block';
                
                const sizeMB = (file.size / (1024 * 1024)).toFixed(2);
                if (homePreviewName) homePreviewName.textContent = `${file.name} (${sizeMB} MB)`;
            };
            reader.readAsDataURL(file);
        } else {
            if (homeDropzoneText) homeDropzoneText.style.display = 'block';
            if (homePreviewBox) homePreviewBox.style.display = 'none';
        }
    });
}
