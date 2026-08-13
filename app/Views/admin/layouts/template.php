<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Admin Panel - Wisata Matras') ?></title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('uploads/favicon/MatrasExplore.png') ?>">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- CSS Styles -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css?v=' . filemtime(FCPATH . 'assets/css/style.css')) ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css?v=' . filemtime(FCPATH . 'assets/css/admin.css')) ?>">
</head>
<body class="admin-body">
    <div class="admin-wrapper">
        <!-- Sidebar Navigation -->
        <aside class="admin-sidebar">
            <div class="admin-sidebar-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5"></path><path d="M2 12l10 5 10-5"></path></svg>
                <h2>DesaWisataMatras</h2>
            </div>
            <ul class="admin-sidebar-menu">
                <li>
                    <a href="<?= base_url('admin') ?>" class="<?= ($active_tab ?? '') === 'dashboard' ? 'active' : '' ?>">
                        <div class="menu-left">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                            <span>Ringkasan</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/entrance') ?>" class="<?= ($active_tab ?? '') === 'entrance' ? 'active' : '' ?>">
                        <div class="menu-left">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            <span>Pengunjung Masuk</span>
                        </div>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('admin/destinations') ?>" class="<?= ($active_tab ?? '') === 'destinations' ? 'active' : '' ?>">
                        <div class="menu-left">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            <span>Destinations</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/gallery') ?>" class="<?= ($active_tab ?? '') === 'gallery' ? 'active' : '' ?>">
                        <div class="menu-left">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                            <span>Visual Gallery</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/shorts') ?>" class="<?= ($active_tab ?? '') === 'shorts' ? 'active' : '' ?>">
                        <div class="menu-left">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.42a2.78 2.78 0 0 0-1.94 2C1 8.18 1 12 1 12s0 3.82.46 5.58a2.78 2.78 0 0 0 1.94 2C5.12 20 12 20 12 20s6.88 0 8.6-.42a2.78 2.78 0 0 0 1.94-2C23 15.82 23 12 23 12s0-3.82-.46-5.58z"></path><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"></polygon></svg>
                            <span>Video Shorts</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/information') ?>" class="<?= ($active_tab ?? '') === 'information' ? 'active' : '' ?>">
                        <div class="menu-left">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                            <span>Manajemen Informasi</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/news') ?>" class="<?= ($active_tab ?? '') === 'news' ? 'active' : '' ?>">
                        <div class="menu-left">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                            <span>Manajemen Berita</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/reviews') ?>" class="<?= ($active_tab ?? '') === 'reviews' ? 'active' : '' ?>">
                        <div class="menu-left">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                            <span>User Reviews</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/photos') ?>" class="<?= ($active_tab ?? '') === 'photos' ? 'active' : '' ?>">
                        <div class="menu-left">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                            <span>User Photos</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/contacts') ?>" class="<?= ($active_tab ?? '') === 'contacts' ? 'active' : '' ?>">
                        <div class="menu-left">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            <span>Contact Inbox</span>
                        </div>
                    </a>
                </li>
            </ul>
            <div style="padding: 1rem; border-top: 1px solid var(--admin-border);">
                <a href="<?= base_url('auth/logout') ?>" style="display: flex; align-items: center; gap: 14px; padding: 14px 18px; color: #ef4444; text-decoration: none; border-radius: 12px; font-weight: 600; font-size: 0.95rem; transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='#fee2e2'" onmouseout="this.style.backgroundColor='transparent'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    <span>Keluar</span>
                </a>
            </div>
        </aside>

        <!-- Main Body -->
        <main class="admin-main">
            <!-- Topbar -->
            <header class="admin-topbar">
                <div class="topbar-title">
                    <h3><?= esc($header_title ?? 'Dashboard Admin') ?></h3>
                </div>
                <div class="topbar-user">
                    <div class="user-profile">
                        <div class="user-avatar">
                            <?= strtoupper(substr(session()->get('admin_name') ?: 'A', 0, 1)) ?>
                        </div>
                        <span style="font-weight: 700; font-size: 0.95rem; color: var(--color-dark);"><?= esc(session()->get('admin_name') ?: 'Administrator') ?></span>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="admin-content">
                <!-- Flash messages are now handled by SweetAlert2 (see script at the bottom) -->

                <?= $this->renderSection('content') ?>
            </div>
        </main>
    </div>

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
        }, true); // Use capture phase to intercept before inline onclick fires
    </script>
</body>
</html>
