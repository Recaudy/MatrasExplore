<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>

<!-- Accommodation Header -->
<section class="page-header warm">
    <div class="container text-center">
        <span class="badge-category" style="background-color: rgba(194, 65, 12, 0.08); color: var(--color-accent);">Akomodasi Terdekat</span>
        <h1 style="margin-bottom: 1rem;">Menginap Nyaman di Dekat Pantai</h1>
        <p class="page-header-desc">Temukan cottage, resor, dan hotel nyaman di sekitar pantai terbaik Bangka. Istirahat dengan tenang dan bangun dengan suara deburan ombak.</p>
    </div>
</section>

<!-- Listings Section -->
<section class="section-padding">
    <div class="container">
        <!-- Search and Filter Bar -->
        <div class="filter-search-container reveal" style="background-color: var(--color-bg-warm); border-color: rgba(194, 65, 12, 0.15);">
            <form action="<?= base_url('accommodation') ?>" method="get" class="search-box">
                <input type="text" name="search" placeholder="Cari nama hotel atau resor..." value="<?= esc($search ?? '') ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </form>
            <div class="filter-box">
                <select onchange="window.location.href = '<?= base_url('accommodation?destination=') ?>' + this.value" class="filter-select">
                    <option value="">Semua Lokasi Pantai</option>
                    <option value="1" <?= ($destination_id ?? '') === '1' ? 'selected' : '' ?>>Dekat Pantai Matras</option>
                    <option value="2" <?= ($destination_id ?? '') === '2' ? 'selected' : '' ?>>Dekat Pantai Jambosag</option>
                    <option value="3" <?= ($destination_id ?? '') === '3' ? 'selected' : '' ?>>Dekat Pantai Turun Aban</option>
                </select>
                <select onchange="window.location.href = '<?= base_url('accommodation?sort=') ?>' + this.value" class="filter-select">
                    <option value="name" <?= ($sort ?? '') === 'name' ? 'selected' : '' ?>>Urutkan Nama (A - Z)</option>
                    <option value="price_asc" <?= ($sort ?? '') === 'price_asc' ? 'selected' : '' ?>>Harga: Terendah ke Tertinggi</option>
                    <option value="price_desc" <?= ($sort ?? '') === 'price_desc' ? 'selected' : '' ?>>Harga: Tertinggi ke Terendah</option>
                </select>
            </div>
        </div>

        <!-- Accommodation Cards Grid -->
        <?php if (empty($accommodations)): ?>
            <div class="text-center reveal" style="padding: 4rem 0;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" width="64" height="64" style="stroke: var(--color-accent); margin-bottom: 1.5rem; opacity: 0.5;">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg>
                <h3>Tidak Ada Akomodasi Ditemukan</h3>
                <p style="color: var(--color-dark-muted); margin-top: 0.5rem;">Kami tidak dapat menemukan penginapan yang sesuai kriteria pencarian Anda. Coba atur ulang filter Anda.</p>
                <a href="<?= base_url('accommodation') ?>" class="btn btn-outline-accent" style="margin-top: 1.5rem;">Atur Ulang Filter</a>
            </div>
        <?php else: ?>
            <div class="accommodations-list-grid">
                <?php foreach ($accommodations as $hotel): ?>
                    <div class="accommodation-card reveal">
                        <div class="card-img-wrapper">
                            <img src="<?= base_url($hotel['image']) ?>" alt="<?= esc($hotel['name']) ?>">
                        </div>
                        <div class="card-content">
                            <span class="card-accent-badge">DEKAT PANTAI <?= esc(strtoupper(str_replace('Pantai ', '', $hotel['destination_name']))) ?></span>
                            <h3 class="card-title" style="font-size: 1.35rem; margin-bottom: 0.75rem;"><?= esc($hotel['name']) ?></h3>
                            
                            <div class="card-rating-row">
                                <div class="rating-stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#EAB308" stroke="#EAB308" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                    </svg>
                                </div>
                                <span class="rating-val"><?= esc($hotel['rating']) ?></span>
                                <span class="rating-divider">&bull;</span>
                                <div class="meta-icons">
                                    <img src="<?= base_url('assets/images/icons/wifi.svg') ?>" alt="wifi" title="Wifi Gratis" width="14" height="14">
                                    <img src="<?= base_url('assets/images/icons/parking.svg') ?>" alt="parking" title="Parkir Gratis" width="14" height="14">
                                    <img src="<?= base_url('assets/images/icons/coffee.svg') ?>" alt="coffee" title="Kopi / Sarapan" width="14" height="14">
                                </div>
                            </div>
                            
                            <div class="card-price-row">
                                <div class="price-info">
                                    <span>Mulai dari</span>
                                    <div class="amount">Rp <?= number_format($hotel['price'] / 1000, 0) ?>K <span style="font-size: 0.8rem; font-weight: normal; color: var(--color-dark-muted);">/ malam</span></div>
                                </div>
                                <a href="<?= base_url('accommodation/' . $hotel['id']) ?>" class="btn btn-book-now">Pesan Sekarang</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?= view('layouts/footer') ?>
<?= view('layouts/scripts') ?>
