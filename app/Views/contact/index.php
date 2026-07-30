<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>

<!-- Contact Page Header -->
<section class="page-header">
    <div class="container text-center">
        <span class="badge-category">Hubungi Kami</span>
        <h1 style="margin-bottom: 1rem;">Kontak Kami</h1>
        <p class="page-header-desc">Punya pertanyaan tentang rencana kunjungan atau panduan wisata lokal? Kami siap membantu liburan impian Anda.</p>
    </div>
</section>

<!-- Contact Form and Details Section -->
<section class="section-padding">
    <div class="container">
        <div class="contact-grid">
            <!-- Contact Info Panel (Left) -->
            <div class="contact-info-panel reveal">
                <div class="contact-info-heading">
                    <h2>Hubungi Kami Secara Langsung</h2>
                    <p>Silakan hubungi kami melalui email, telepon, atau kunjungi pusat informasi wisata kami di Sungailiat.</p>
                </div>
                
                <div class="contact-cards-stack">
                    <div class="contact-info-card">
                        <div class="contact-info-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <div class="contact-info-card-text">
                            <h4>Pusat Informasi Wisata (Visitor Center)</h4>
                            <p><?= esc($settings['contact_address'] ?? 'Jl. Pantai Matras, Sungailiat, Bangka') ?></p>
                        </div>
                    </div>
                    
                    <div class="contact-info-card">
                        <div class="contact-info-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                        </div>
                        <div class="contact-info-card-text">
                            <h4>Telepon / WhatsApp</h4>
                            <p><?= esc($settings['contact_phone'] ?? '+62 717 123 456') ?></p>
                        </div>
                    </div>
                    
                    <div class="contact-info-card">
                        <div class="contact-info-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </div>
                        <div class="contact-info-card-text">
                            <h4>Layanan Email</h4>
                            <p><?= esc($settings['contact_email'] ?? 'hello@explorebangka.id') ?></p>
                        </div>
                    </div>
                    
                    <div class="contact-info-card">
                        <div class="contact-info-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <div class="contact-info-card-text">
                            <h4>Jam Operasional</h4>
                            <p><?= esc($settings['contact_hours'] ?? 'Setiap Hari • 08:00 — 17:00 WIB') ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form Panel (Right) -->
            <div class="contact-form-panel reveal">
                <!-- Flash Messages -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        <ul style="padding-left: 20px; list-style-type: disc;">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Contact Form -->
                <form action="<?= base_url('contact/send') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="form-group-row">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" required placeholder="Masukkan nama lengkap" value="<?= old('name') ?>">
                        </div>
                        <div class="form-group">
                            <label for="phone">No. WhatsApp</label>
                            <input type="text" id="phone" name="phone" required placeholder="+62 8..." value="<?= old('phone') ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subjek / Topik</label>
                        <input type="text" id="subject" name="subject" required placeholder="Apa yang ingin Anda tanyakan?" value="<?= old('subject') ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Isi Pesan</label>
                        <textarea id="message" name="message" required placeholder="Tuliskan pertanyaan, saran, atau pesan Anda secara detail di sini..."><?= old('message') ?></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 1rem; padding: 14px 28px; border-radius: var(--border-radius-full); font-weight: 700;">
                        Kirim Pesan Sekarang
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16" style="margin-left: 6px;">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const contactForms = document.querySelectorAll('form[action$="contact/send"]');
    
    // Ensure showToast exists (fallback if gallery.js not loaded)
    const toastFn = typeof showToast === 'function' ? showToast : (message, type) => {
        alert(message);
    };

    contactForms.forEach(form => {
        const phoneInput = form.querySelector('input[name="phone"]');
        
        if (phoneInput) {
            // Auto convert 08 to +62
            phoneInput.addEventListener('input', function(e) {
                let val = this.value;
                if (val.startsWith('08')) {
                    this.value = '+628' + val.substring(2);
                }
            });
        }

        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Remove existing error messages
            form.querySelectorAll('.error-message').forEach(el => el.remove());
            form.querySelectorAll('input, textarea, select').forEach(el => el.style.borderColor = '');

            const submitBtn = this.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;
            submitBtn.innerHTML = 'Mengirim...';
            submitBtn.disabled = true;

            const formData = new FormData(this);
            
            try {
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                
                const result = await response.json();
                
                if (result.success) {
                    toastFn(result.message, 'success');
                    form.reset();
                } else {
                    toastFn('Terdapat kesalahan pada input Anda. Silakan periksa kembali.', 'error');
                    if (result.errors) {
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
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                toastFn('Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.', 'error');
            } finally {
                submitBtn.innerHTML = originalBtnText;
                submitBtn.disabled = false;
            }
        });
    });
});
</script>

<?= view('layouts/footer') ?>
<?= view('layouts/scripts') ?>
