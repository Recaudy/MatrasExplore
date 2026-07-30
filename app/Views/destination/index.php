<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>

<!-- Destinations Header -->
<section class="page-header">
    <div class="container text-center">
        <span class="badge-category">Garis Pantai Kami</span>
        <h1 style="margin-bottom: 1rem;">Jelajahi Destinasi Bangka</h1>
        <p class="page-header-desc">Temukan pantai berpasir putih, teluk tersembunyi, formasi batuan granit eksotis, dan ketenangan alam di sepanjang pesisir Pulau Bangka.</p>
    </div>
</section>

<!-- Listings Section -->
<section class="section-padding">
    <div class="container">
        <!-- Search and Filter Bar -->
        <div class="filter-search-container reveal">
            <form action="<?= base_url('destinations') ?>" method="get" class="search-box">
                <input type="text" name="search" placeholder="Cari nama atau lokasi pantai..." value="<?= esc($search ?? '') ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </form>
            <div class="filter-box">
                <select onchange="window.location.href = '<?= base_url('destinations?location=') ?>' + this.value" class="filter-select">
                    <option value="">Semua Lokasi</option>
                    <option value="Sungailiat" <?= ($location ?? '') === 'Sungailiat' ? 'selected' : '' ?>>Sungailiat</option>
                    <option value="Belinyu" <?= ($location ?? '') === 'Belinyu' ? 'selected' : '' ?>>Belinyu</option>
                </select>
                <select onchange="window.location.href = '<?= base_url('destinations?sort=') ?>' + this.value" class="filter-select">
                    <option value="name" <?= ($sort ?? '') === 'name' ? 'selected' : '' ?>>Urutkan Nama (A - Z)</option>
                    <option value="price_asc" <?= ($sort ?? '') === 'price_asc' ? 'selected' : '' ?>>Harga: Terendah ke Tertinggi</option>
                    <option value="price_desc" <?= ($sort ?? '') === 'price_desc' ? 'selected' : '' ?>>Harga: Tertinggi ke Terendah</option>
                </select>
            </div>
        </div>

        <!-- Cards Grid -->
        <?php if (empty($destinations)): ?>
            <div class="text-center reveal" style="padding: 4rem 0;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" width="64" height="64" style="stroke: var(--color-primary); margin-bottom: 1.5rem; opacity: 0.5;">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg>
                <h3>Tidak Ada Destinasi Ditemukan</h3>
                <p style="color: var(--color-dark-muted); margin-top: 0.5rem;">Kami tidak dapat menemukan destinasi yang sesuai kriteria pencarian Anda. Coba atur ulang filter Anda.</p>
                <a href="<?= base_url('destinations') ?>" class="btn btn-outline-primary" style="margin-top: 1.5rem;">Atur Ulang Filter</a>
            </div>
        <?php else: ?>
            <div class="destinations-grid">
                <?php foreach ($destinations as $index => $dest): ?>
                    <div class="destination-card reveal">
                        <div class="card-img-wrapper">
                            <img src="<?= base_url($dest['image']) ?>" alt="<?= esc($dest['name']) ?>">
                            <span class="card-rating-badge badge-rating">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#EAB308" stroke="#EAB308" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                </svg>
                                <?= esc($dest['rating'] ?? '4.7') ?>
                            </span>
                            <span class="card-number-badge"><?= sprintf('%02d', $index + 1) ?></span>
                        </div>
                        <div class="card-content">
                            <span class="card-location"><?= esc($dest['location']) ?></span>
                            <h3 class="card-title"><?= esc($dest['name']) ?></h3>
                            <p class="card-desc"><?= esc($dest['description']) ?></p>
                            
                            <div class="card-meta-bottom">
                                <span class="meta-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16" style="stroke: var(--color-primary);">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    <?= esc(str_replace(['May', 'June', 'July', 'August', 'September', 'October', 'April'], ['Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'April'], $dest['season'] ?? 'Mei — Sept')) ?>
                                </span>
                                <div class="meta-icons">
                                    <?php foreach ($dest['facilities'] as $facility): ?>
                                        <img src="<?= base_url('assets/images/icons/' . $facility['icon'] . '.svg') ?>" alt="<?= esc($facility['name']) ?>" title="<?= esc($facility['name']) ?>" width="16" height="16">
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <a href="<?= base_url('destinations/' . $dest['slug']) ?>" class="card-link">
                                Selengkapnya
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?= view('layouts/footer') ?>
<?= view('layouts/scripts') ?>
