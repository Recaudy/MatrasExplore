<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>

<section class="section-padding" style="padding-top: 8rem;">
    <div class="container accommodation-detail-container">
        <!-- Back Link -->
        <a href="<?= base_url('accommodation') ?>" class="card-link" style="display: inline-flex; align-items: center; gap: 8px; margin-bottom: 2rem; font-weight: 700; color: var(--color-accent);">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="18" height="18" style="transform: rotate(180deg); stroke: currentColor;">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
            Kembali ke daftar akomodasi
        </a>

        <!-- Top Gallery Grid Layout (1 Large, 2 Stacked Side Images) -->
        <div class="accommodation-gallery-grid reveal">
            <div class="accommodation-gallery-main">
                <img src="<?= base_url($accommodation['image']) ?>" alt="<?= esc($accommodation['name']) ?>">
            </div>
            <div class="accommodation-gallery-side">
                <div class="accommodation-gallery-side-img">
                    <!-- Second image fallback -->
                    <img src="<?= base_url('assets/images/destinations/matras_2.jpg') ?>" alt="resort pool view">
                </div>
                <div class="accommodation-gallery-side-img">
                    <!-- Third image fallback -->
                    <img src="<?= base_url('assets/images/gallery/island_sunset.jpg') ?>" alt="resort shoreline view">
                </div>
            </div>
        </div>

        <!-- Detail Meta Split Grid -->
        <div class="accommodation-detail-grid">
            <!-- Left Info Column -->
            <div class="accommodation-info-main">
                <!-- Title and Location info -->
                <div class="accommodation-title-area reveal">
                    <span class="badge-category" style="background-color: var(--color-accent-light); color: var(--color-accent); margin-bottom: 0.75rem;">DEKAT PANTAI <?= esc(strtoupper(str_replace('Pantai ', '', $accommodation['destination_name']))) ?></span>
                    <h1 style="margin-bottom: 8px;"><?= esc($accommodation['name']) ?></h1>
                    
                    <div class="card-rating-row" style="margin-bottom: 0;">
                        <div class="rating-stars">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#EAB308" stroke="#EAB308" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                        </div>
                        <span class="rating-val" style="font-weight: 700;"><?= esc($accommodation['rating']) ?> dari 5</span>
                        <span class="rating-divider">&bull;</span>
                        <span style="color: var(--color-dark-muted); font-size: 0.9rem;"><?= esc($accommodation['address']) ?></span>
                    </div>
                </div>

                <!-- Description -->
                <div class="reveal">
                    <h2 class="detail-section-title">Tentang Penginapan</h2>
                    <p class="detail-text"><?= esc($accommodation['description']) ?></p>
                </div>

                <!-- Amenities Checklist -->
                <div class="reveal">
                    <h2 class="detail-section-title">Fasilitas & Layanan</h2>
                    <div class="amenities-grid">
                        <div class="amenity-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12.55a11 11 0 0 1 14.08 0"></path>
                                <path d="M1.42 9a16 16 0 0 1 21.16 0"></path>
                                <path d="M8.53 16.11a6 6 0 0 1 6.95 0"></path>
                                <line x1="12" y1="20" x2="12.01" y2="20" stroke-width="3"></line>
                            </svg>
                            <span>Wi-Fi Gratis</span>
                        </div>
                        <div class="amenity-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M9 17V7h4a3 3 0 0 1 0 6H9"></path>
                            </svg>
                            <span>Parkir Gratis</span>
                        </div>
                        <div class="amenity-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 8h1a4 4 0 0 1 0 8h-1"></path>
                                <path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path>
                                <line x1="6" y1="2" x2="6" y2="4"></line>
                                <line x1="10" y1="2" x2="10" y2="4"></line>
                                <line x1="14" y1="2" x2="14" y2="4"></line>
                            </svg>
                            <span>Kedai Kopi / Sarapan</span>
                        </div>
                        <div class="amenity-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="3" width="20" height="10" rx="2"></rect>
                                <line x1="6" y1="18" x2="6" y2="21"></line>
                                <line x1="12" y1="18" x2="12" y2="21"></line>
                                <line x1="18" y1="18" x2="18" y2="21"></line>
                                <path d="M4 13c0 2 1.5 3 3.5 3s3.5-1 3.5-3m-7 0v2m14-2c0 2-1.5 3-3.5 3s-3.5-1-3.5-3m7 0v2"></path>
                            </svg>
                            <span>AC (Pendingin Ruangan)</span>
                        </div>
                        <div class="amenity-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 20a2.4 2.4 0 0 0 2 1 2.4 2.4 0 0 0 2-1 2.4 2.4 0 0 1 2-1 2.4 2.4 0 0 1 2 1 2.4 2.4 0 0 0 2 1 2.4 2.4 0 0 0 2-1 2.4 2.4 0 0 1 2-1 2.4 2.4 0 0 1 2 1 2.4 2.4 0 0 0 2 1 2.4 2.4 0 0 0 2-1"></path>
                                <path d="M2 16a2.4 2.4 0 0 0 2 1 2.4 2.4 0 0 0 2-1 2.4 2.4 0 0 1 2-1 2.4 2.4 0 0 1 2 1 2.4 2.4 0 0 0 2 1 2.4 2.4 0 0 0 2-1 2.4 2.4 0 0 1 2-1 2.4 2.4 0 0 1 2 1 2.4 2.4 0 0 0 2 1 2.4 2.4 0 0 0 2-1"></path>
                                <path d="M10 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"></path>
                                <path d="M14 8V6a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v3h8z"></path>
                            </svg>
                            <span>Kolam Renang</span>
                        </div>
                        <div class="amenity-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                            </svg>
                            <span>Restoran</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar Column -->
            <div class="detail-sidebar">
                <!-- Pricing & Actions card -->
                <div class="accommodation-price-box reveal">
                    <div class="price-label">Tarif Kamar</div>
                    <div class="price-val">Rp <?= number_format($accommodation['price'], 0, ',', '.') ?> <span style="font-size: 0.95rem; font-weight: normal; color: var(--color-dark-muted);">/ malam</span></div>
                    
                    <a href="<?= esc($accommodation['website']) ?>" target="_blank" class="btn btn-dark" style="margin-bottom: 12px;">
                        Pesan Sekarang
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                            <polyline points="15 3 21 3 21 9"></polyline>
                            <line x1="10" y1="14" x2="21" y2="3"></line>
                        </svg>
                    </a>
                    
                    <a href="tel:<?= esc($accommodation['phone']) ?>" class="btn btn-outline-accent">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                        Hubungi Penginapan
                    </a>
                </div>

                <!-- Location details card -->
                <div class="sidebar-card reveal">
                    <h3 class="sidebar-card-title">Detail Lokasi</h3>
                    <p style="font-size: 0.95rem; line-height: 1.6; color: var(--color-dark-muted); margin-bottom: 1.5rem;"><?= esc($accommodation['address']) ?></p>
                    <ul class="info-list" style="margin-bottom: 1.5rem;">
                        <li>
                            <span class="label">Garis Lintang</span>
                            <span class="value"><?= esc($accommodation['latitude']) ?></span>
                        </li>
                        <li>
                            <span class="label">Garis Bujur</span>
                            <span class="value"><?= esc($accommodation['longitude']) ?></span>
                        </li>
                    </ul>
                    <a href="https://maps.google.com/?q=<?= esc($accommodation['latitude']) ?>,<?= esc($accommodation['longitude']) ?>" target="_blank" class="btn btn-primary" style="width: 100%; background: linear-gradient(135deg, var(--color-primary), #0d9488); color: #ffffff; font-weight: 700; border-radius: 8px;">
                        Buka di Google Maps
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?= view('layouts/footer') ?>
<?= view('layouts/scripts') ?>
