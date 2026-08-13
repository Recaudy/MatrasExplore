<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="referrer" content="strict-origin-when-cross-origin">
    <meta name="description" content="<?= esc($meta_description ?? 'Jelajahi keindahan Pantai Matras, Pantai Jambosag, dan Pantai Turun Aban di Desa Wisata Matras. Temukan pesona pantai pasir putih, air laut jernih, budaya lokal, serta rute perjalanan lengkap.') ?>">
    <meta name="keywords" content="Bangka Beach, Wisata Bangka, Pantai Matras, Pantai Jambosag, Pantai Turun Aban, Bangka Tourism, Desa Wisata Matras">
    <title><?= esc($title ?? 'Desa Wisata Matras - Sistem Informasi Pariwisata') ?></title>
    
    <!-- Base URL for Assets -->
    <link rel="icon" type="image/png" href="<?= base_url('uploads/favicon/MatrasExplore.png') ?>">

    <!-- Leaflet.js Mapping Library CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <!-- Global CSS Design System -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/navbar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/footer.css') ?>">
    
    <!-- Dynamic Page Specific Styles -->
    <?php if (isset($pageStyles)): ?>
        <?php foreach ($pageStyles as $style): ?>
            <link rel="stylesheet" href="<?= base_url('assets/css/' . $style) ?>">
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Responsiveness stylesheet -->
    <link rel="stylesheet" href="<?= base_url('assets/css/responsive.css') ?>">
</head>
<body>
