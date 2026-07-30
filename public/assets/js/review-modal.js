/* Review Form Modal & Star Rating JS */

document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('reviewModal');
    const btnOpen = document.getElementById('btnOpenReviewModal');
    const btnClose = document.getElementById('btnCloseReviewModal');
    const btnCancel = document.getElementById('btnCancelReviewModal');
    const ratingInputs = document.querySelectorAll('.star-rating-input input[type="radio"]');
    const ratingText = document.getElementById('ratingValueText');

    if (!modal || !btnOpen) return;

    // Open modal
    btnOpen.addEventListener('click', () => {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden'; // Lock background scrolling
    });

    // Close modal function
    const closeModal = () => {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    };

    if (btnClose) btnClose.addEventListener('click', closeModal);
    if (btnCancel) btnCancel.addEventListener('click', closeModal);

    // Close on backdrop click (outside modal box)
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });

    // Close on Escape key press
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.classList.contains('active')) {
            closeModal();
        }
    });

    // Star rating text helper
    const ratingLabels = {
        5: '5.0 • Sangat Puas ★★★★★',
        4: '4.0 • Puas ★★★★',
        3: '3.0 • Cukup ★★★',
        2: '2.0 • Kurang ★★',
        1: '1.0 • Sangat Kurang ★'
    };

    ratingInputs.forEach(input => {
        input.addEventListener('change', (e) => {
            const val = e.target.value;
            if (ratingText && ratingLabels[val]) {
                ratingText.innerHTML = ratingLabels[val];
            }
        });
    });

    // Handle Review Form Submit via AJAX
    const reviewForm = modal.querySelector('form');
    if (reviewForm) {
        reviewForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            // Clear previous errors
            reviewForm.querySelectorAll('.error-message').forEach(el => el.remove());
            reviewForm.querySelectorAll('input, textarea, select').forEach(el => el.style.borderColor = 'var(--color-light-border)');

            const formData = new FormData(reviewForm);

            try {
                const response = await fetch(reviewForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                
                const result = await response.json();

                if (result.status === 'success') {
                    if (typeof showToast === 'function') {
                        showToast(result.message, 'success');
                    } else {
                        alert(result.message);
                    }
                    reviewForm.reset();
                    if (ratingText) ratingText.innerHTML = '5.0 • Sangat Puas ★★★★★'; // reset text
                    closeModal();
                } else if (result.status === 'error' && result.errors) {
                    for (const field in result.errors) {
                        const input = reviewForm.querySelector(`[name="${field}"]`);
                        if (input) {
                            // Except radio buttons (rating), standard inputs get red border
                            if (input.type !== 'radio') {
                                input.style.borderColor = '#ef4444';
                            }
                            
                            const errorMsg = document.createElement('div');
                            errorMsg.className = 'error-message';
                            errorMsg.style.color = '#ef4444';
                            errorMsg.style.fontSize = '0.8rem';
                            errorMsg.style.marginTop = '4px';
                            errorMsg.textContent = result.errors[field];
                            
                            if (input.type === 'radio') {
                                // Insert after the star rating container
                                const starContainer = input.closest('.star-rating-input');
                                if (starContainer && starContainer.parentNode) {
                                    starContainer.parentNode.appendChild(errorMsg);
                                }
                            } else {
                                input.parentNode.appendChild(errorMsg);
                            }
                        }
                    }
                }
            } catch (err) {
                console.error("Review submission error:", err);
                if (typeof showToast === 'function') showToast("Terjadi kesalahan jaringan.", "error");
            }
        });
    }
});
