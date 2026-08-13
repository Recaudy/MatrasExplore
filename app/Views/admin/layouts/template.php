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
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
    <!-- Inline Admin Overrides (syncs via app/Views, not public folder) -->
    <style>
        /* ===== ADMIN PANEL CORE STYLES ===== */
        :root {
            --admin-bg: #f8fafc;
            --admin-sidebar: #ffffff;
            --admin-sidebar-hover: rgba(10, 168, 167, 0.06);
            --admin-sidebar-active: rgba(10, 168, 167, 0.12);
            --admin-card-bg: #ffffff;
            --admin-border: #f1f5f9;
            --font-sans: 'Plus Jakarta Sans', sans-serif;
            --font-heading: 'Outfit', sans-serif;
            --admin-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
            --admin-shadow-hover: 0 4px 12px rgba(0, 0, 0, 0.05);
            --admin-radius: 16px;
        }

        body.admin-body {
            margin: 0; padding: 0;
            background-color: var(--admin-bg);
            font-family: var(--font-sans);
            color: var(--color-dark-muted);
        }

        body.admin-body h1, body.admin-body h2, body.admin-body h3,
        body.admin-body h4, body.admin-body h5, body.admin-body h6 {
            font-family: var(--font-heading);
            color: var(--color-dark);
            font-weight: 700;
        }

        .admin-wrapper { display: flex; min-height: 100vh; }

        /* Sidebar */
        .admin-sidebar {
            width: 280px;
            background-color: var(--admin-sidebar);
            color: var(--color-dark-muted);
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 100;
            border-right: 1px solid var(--admin-border);
        }

        .admin-sidebar-header {
            padding: 1.75rem 1.5rem 1.5rem;
            display: flex; align-items: center; gap: 12px;
        }

        .admin-sidebar-header h2 {
            color: var(--color-dark); font-size: 1.35rem;
            font-weight: 800; margin: 0; letter-spacing: 0.5px;
        }

        .admin-sidebar-menu {
            list-style: none !important; padding: 0.75rem 1rem !important; margin: 0 !important;
            flex: 1; display: flex; flex-direction: column; gap: 4px !important;
        }

        .admin-sidebar-menu li {
            margin: 0 !important; padding: 0 !important; list-style: none !important;
            line-height: normal !important;
        }

        .admin-sidebar-menu li a {
            display: flex; align-items: center; justify-content: space-between;
            padding: 12px 18px !important; color: var(--color-dark-muted);
            text-decoration: none; border-radius: 12px;
            font-weight: 600; font-size: 0.95rem; transition: all 0.3s ease;
            margin: 0 !important; line-height: 1.4 !important;
        }

        .admin-sidebar-menu li a .menu-left {
            display: flex; align-items: center; gap: 14px;
        }

        .admin-sidebar-menu li a:hover {
            background-color: var(--admin-sidebar-hover);
            color: var(--color-primary); transform: translateX(4px);
        }

        .admin-sidebar-menu li a.active {
            background-color: var(--admin-sidebar-active);
            color: var(--color-primary);
        }

        .menu-badge {
            background-color: #f43f5e; color: white;
            font-size: 0.72rem; font-weight: 800;
            padding: 2px 8px; border-radius: 20px;
        }

        /* Main Content */
        .admin-main { flex: 1; display: flex; flex-direction: column; min-width: 0; }

        .admin-topbar {
            height: 80px; background-color: var(--admin-card-bg);
            border-bottom: 1px solid var(--admin-border);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 2.5rem;
        }

        .topbar-title h3 {
            margin: 0; font-size: 1.5rem; font-weight: 800;
            color: var(--color-dark);
        }

        .topbar-user { display: flex; align-items: center; gap: 1.5rem; }
        .user-profile { display: flex; align-items: center; gap: 12px; }

        .user-avatar {
            width: 44px; height: 44px; border-radius: 50%;
            background: linear-gradient(135deg, var(--color-primary), #0d9488);
            color: white; font-weight: 800;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; box-shadow: 0 4px 10px rgba(10, 168, 167, 0.3);
            flex-shrink: 0;
        }

        .user-profile span { white-space: nowrap; }

        .admin-content { padding: 2.5rem; flex: 1; }

        /* Stats Grid */
        .admin-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.75rem; margin-bottom: 2.5rem;
        }

        .admin-stat-card {
            background-color: var(--admin-card-bg);
            border: 1px solid var(--admin-border);
            border-radius: var(--admin-radius); padding: 1.75rem;
            display: flex; align-items: center; justify-content: space-between;
            box-shadow: var(--admin-shadow);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .admin-stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--admin-shadow-hover);
            border-color: rgba(10, 168, 167, 0.3);
        }

        .stat-info span {
            font-size: 0.85rem; font-weight: 700; color: #64748b;
            text-transform: uppercase; letter-spacing: 0.5px;
            display: block; margin-bottom: 8px;
        }

        .stat-info h3 {
            font-size: 2.25rem; font-weight: 800; color: var(--color-dark);
            margin: 0; line-height: 1;
        }

        .stat-icon {
            width: 64px; height: 64px; border-radius: 18px;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.3s ease;
        }

        .admin-stat-card:hover .stat-icon { transform: scale(1.05) rotate(5deg); }

        /* Dashboard Card Gradients */
        .admin-stat-card.bg-gradient-blue {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border-color: #bae6fd;
        }
        .admin-stat-card.bg-gradient-blue h3 { color: #0369a1; }
        .admin-stat-card.bg-gradient-blue .stat-icon { background-color: #0284c7; color: white; }

        .admin-stat-card.bg-gradient-amber {
            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
            border-color: #fde68a;
        }
        .admin-stat-card.bg-gradient-amber h3 { color: #b45309; }
        .admin-stat-card.bg-gradient-amber .stat-icon { background-color: #d97706; color: white; }

        .admin-stat-card.bg-gradient-teal {
            background: linear-gradient(135deg, #f0fdfa 0%, #ccfbf1 100%);
            border-color: #99f6e4;
        }
        .admin-stat-card.bg-gradient-teal h3 { color: #0f766e; }
        .admin-stat-card.bg-gradient-teal .stat-icon { background-color: #0d9488; color: white; }

        .admin-stat-card.bg-gradient-rose {
            background: linear-gradient(135deg, #fff1f2 0%, #ffe4e6 100%);
            border-color: #fecdd3;
        }
        .admin-stat-card.bg-gradient-rose h3 { color: #be123c; }
        .admin-stat-card.bg-gradient-rose .stat-icon { background-color: #e11d48; color: white; }

        .admin-stat-card.bg-gradient-indigo {
            background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%);
            border-color: #c7d2fe;
        }
        .admin-stat-card.bg-gradient-indigo h3 { color: #4338ca; }
        .admin-stat-card.bg-gradient-indigo .stat-icon { background-color: #6366f1; color: white; }

        /* Card & Table */
        .admin-card {
            background-color: var(--admin-card-bg);
            border: 1px solid var(--admin-border);
            border-radius: var(--admin-radius);
            box-shadow: var(--admin-shadow);
            overflow: hidden; margin-bottom: 2.5rem;
            transition: box-shadow 0.3s ease;
        }
        .admin-card:hover { box-shadow: var(--admin-shadow-hover); }

        .admin-card-header {
            padding: 1.5rem 2rem; display: flex; align-items: center;
            justify-content: space-between; flex-wrap: wrap; gap: 1rem;
            background-color: #ffffff;
        }
        .admin-card-header h4 {
            margin: 0; font-size: 1.25rem; font-weight: 800;
            color: var(--color-dark);
        }

        .table-responsive { overflow-x: auto; }

        .admin-table { width: 100%; border-collapse: collapse; }
        .admin-table th {
            background-color: #f8fafc; padding: 16px 24px;
            text-align: left; font-size: 0.85rem; font-weight: 700;
            color: #475569; text-transform: uppercase; letter-spacing: 0.5px;
        }
        .admin-table td {
            padding: 18px 24px; border-bottom: 1px solid var(--admin-border);
            font-size: 0.95rem; color: #334155; vertical-align: middle;
        }
        .admin-table th:first-child, .admin-table td:first-child { padding-left: 2rem; }
        .admin-table th:last-child, .admin-table td:last-child { padding-right: 2rem; }
        .admin-table tr { transition: background-color 0.2s ease; }
        .admin-table tr:hover { background-color: #f8fafc; }
        .admin-table tr:last-child td { border-bottom: none; }

        /* Status Badges */
        .status-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 6px 14px; border-radius: 20px;
            font-size: 0.8rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.5px;
        }
        .status-badge.approved, .status-badge.active { background-color: #dcfce7; color: #166534; }
        .status-badge.pending { background-color: #fef9c3; color: #854d0e; }
        .status-badge.rejected { background-color: #fee2e2; color: #991b1b; }

        /* Action Buttons */
        .btn-group-action { display: flex; gap: 6px; flex-wrap: nowrap; white-space: nowrap; }

        .btn-sm {
            padding: 8px 14px; font-size: 0.85rem; border-radius: 8px;
            font-weight: 700; display: inline-flex; align-items: center;
            gap: 8px; text-decoration: none; border: none; cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-primary { background-color: var(--color-primary); color: #ffffff !important; border-color: transparent; }
        .btn-primary:hover { background-color: var(--color-primary-dark); color: #ffffff !important; transform: translateY(-2px); }
        .btn-reject { background-color: #f59e0b; color: #ffffff !important; }
        .btn-reject:hover { background-color: #d97706; transform: translateY(-2px); }
        .btn-warning { background-color: #eab308; color: #ffffff !important; border: none; }
        .btn-warning:hover { background-color: #ca8a04; transform: translateY(-2px); }
        .btn-danger { background-color: #ef4444; color: #ffffff !important; border: none; }
        .btn-danger:hover { background-color: #dc2626; transform: translateY(-2px); }
        .btn-delete { background-color: #ef4444; color: #ffffff !important; }
        .btn-delete:hover { background-color: #dc2626; transform: translateY(-2px); }
        .btn-edit { background-color: #3b82f6; color: #ffffff !important; }
        .btn-edit:hover { background-color: #2563eb; transform: translateY(-2px); }
        .btn-success { background-color: #10b981; color: #ffffff !important; border: none; }
        .btn-success:hover { background-color: #059669; transform: translateY(-2px); }
        .btn-approve { background-color: #10b981; color: #ffffff !important; border: none; }
        .btn-approve:hover { background-color: #059669; transform: translateY(-2px); }

        /* Utility */
        .text-center { text-align: center; }
        .text-danger { color: #ef4444; }
        .text-success { color: #10b981; }
        .text-primary { color: var(--color-primary); }
        .text-muted { color: #64748b; }
        .alert-success { background-color: #d1fae5; color: #065f46; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-weight: 600; }
        .font-bold { font-weight: 700; }
        .font-semibold { font-weight: 600; }
        .mb-0 { margin-bottom: 0 !important; }
        .mb-1 { margin-bottom: 0.5rem; }
        .mb-2 { margin-bottom: 1rem; }
        .mb-3 { margin-bottom: 1.5rem; }
        .mb-4 { margin-bottom: 2rem; }
        .mt-2 { margin-top: 1rem; }
        .p-2 { padding: 1rem; }
        .p-3 { padding: 1.5rem; }
        .p-4 { padding: 2rem; }
        .d-flex { display: flex; }
        .align-items-center { align-items: center; }
        .justify-content-between { justify-content: space-between; }
        .justify-content-end { justify-content: flex-end; }
        .gap-2 { gap: 0.5rem; }
        .gap-3 { gap: 1rem; }
        .w-100 { width: 100%; }
        .admin-grid-2 { display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 2rem; }
        .admin-grid-half { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
        .btn-outline { background: transparent; border: 1px solid #cbd5e1; color: #475569; }
        .btn-outline:hover { background: #f8fafc; border-color: #94a3b8; transform: translateY(-2px); }
        .btn-light { background: #f1f5f9; color: #334155; border: none; }
        .btn-light:hover { background: #e2e8f0; color: #1e293b; transform: translateY(-2px); }

        /* Form Controls */
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; font-weight: 600; font-size: 0.95rem; color: var(--color-dark); }
        .form-control { width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 8px; font-family: var(--font-sans); }
        .form-control:focus { outline: none; border-color: var(--color-primary); box-shadow: 0 0 0 3px rgba(10, 168, 167, 0.1); }
        textarea.form-control { resize: vertical; }

        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5); backdrop-filter: blur(2px); }
        .modal-content { background-color: #fff; margin: 5% auto; padding: 0; border: none; border-radius: 12px; width: 90%; max-width: 500px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); animation: modalFadeIn 0.3s ease; }
        @keyframes modalFadeIn { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        .modal-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--admin-border); display: flex; justify-content: space-between; align-items: center; }
        .modal-header h3 { margin: 0; font-size: 1.25rem; }
        .modal-header .close { color: #94a3b8; font-size: 1.5rem; font-weight: bold; cursor: pointer; transition: color 0.2s; }
        .modal-header .close:hover { color: #ef4444; }
        .modal-body { padding: 1.5rem; }

        .empty-state { padding: 3rem; text-align: center; color: #64748b; }
        .empty-state svg { margin: 0 auto 15px; display: block; stroke: #cbd5e1; }
        .empty-state p { margin: 0; font-weight: 600; font-size: 1.05rem; }
        .admin-card-body { padding: 1.5rem; }

        /* Responsive */
        @media (max-width: 992px) {
            .admin-sidebar { width: 80px; }
            .admin-sidebar-header h2, .admin-sidebar-menu li a span { display: none; }
            .admin-sidebar-menu li a { justify-content: center; padding: 16px 0; }
            .admin-topbar { padding: 0 1.5rem; }
            .admin-content { padding: 1.5rem; }
            .admin-stats-grid { grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); }
        }

        @media (max-width: 768px) {
            .admin-wrapper { flex-direction: column; }
            .admin-sidebar {
                width: 100%; height: auto; flex-direction: row;
                padding: 0.5rem 1rem; overflow-x: auto;
                border-right: none; border-bottom: 1px solid rgba(255,255,255,0.1);
            }
            .admin-sidebar-header { display: none; }
            .admin-sidebar-menu { flex-direction: row; padding: 0; gap: 15px; align-items: center; width: max-content; }
            .admin-sidebar-menu li a { padding: 10px; justify-content: center; }
            .admin-content { padding: 1rem; }
            .admin-card-header { flex-direction: column; align-items: flex-start; gap: 10px; }
            div[style*="display: grid;"] { grid-template-columns: 1fr !important; }
            .topbar-user { gap: 10px; }
            .topbar-title h3 { font-size: 1.2rem; }
            .admin-topbar { padding: 0 1rem; }
            .btn-sm { font-size: 0.75rem; padding: 6px 10px; }
            .user-profile span { display: none; }
        }
    </style>
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
