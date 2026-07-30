<!-- Explore Bangka Beaches - Scripts Layout Component -->

<!-- Leaflet.js Mapping Library JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<!-- Global Site Script files -->
<script src="<?= base_url('assets/js/main.js') ?>"></script>
<script src="<?= base_url('assets/js/navbar.js') ?>"></script>
<script src="<?= base_url('assets/js/animation.js') ?>"></script>

<!-- Dynamic Page Specific Scripts -->
<?php if (isset($pageScripts)): ?>
    <?php foreach ($pageScripts as $script): ?>
        <script src="<?= base_url('assets/js/' . $script) ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .swal2-popup {
        font-family: 'Plus Jakarta Sans', sans-serif;
        border-radius: 16px;
    }
    .swal2-title {
        font-family: 'Outfit', sans-serif;
    }
    .swal2-confirm, .swal2-cancel {
        border-radius: 10px !important;
        font-weight: 600 !important;
        padding: 10px 24px !important;
    }
</style>
<script>
    // Handle Flash Messages with SweetAlert2 Toasts
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });

    <?php if (session()->getFlashdata('success')): ?>
        Toast.fire({
            icon: 'success',
            title: <?= json_encode(session()->getFlashdata('success')) ?>
        });
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        Toast.fire({
            icon: 'error',
            title: <?= json_encode(session()->getFlashdata('error')) ?>
        });
    <?php endif; ?>

    // Intercept native confirm() dialogs on elements with onclick="return confirm(...)"
    document.addEventListener('click', function(e) {
        let target = e.target.closest('[onclick*="return confirm"]');
        if (target) {
            // Prevent the inline onclick from firing
            e.preventDefault();
            e.stopPropagation();
            
            // Extract the message from the onclick attribute
            let onclickAttr = target.getAttribute('onclick');
            let match = onclickAttr.match(/confirm\(['"](.*?)['"]\)/);
            let msg = match ? match[1] : 'Apakah Anda yakin ingin melanjutkan tindakan ini?';
            
            // Show SweetAlert popup
            Swal.fire({
                title: 'Konfirmasi',
                text: msg,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0aa8a7',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, Lanjutkan',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Action confirmed
                    if (target.tagName.toLowerCase() === 'a') {
                        window.location.href = target.getAttribute('href');
                    } else if (target.tagName.toLowerCase() === 'button' || target.tagName.toLowerCase() === 'input') {
                        let form = target.closest('form');
                        if(form) {
                            target.removeAttribute('onclick');
                            // append a hidden input to simulate button click if it has a name
                            if (target.name) {
                                let hidden = document.createElement('input');
                                hidden.type = 'hidden';
                                hidden.name = target.name;
                                hidden.value = target.value || '1';
                                form.appendChild(hidden);
                            }
                            form.submit();
                        }
                    }
                }
            });
        }
    }, true);
</script>

</body>
</html>
