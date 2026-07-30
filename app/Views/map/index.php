<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>

<main class="map-page-layout">
    <!-- Map Canvas (Leaflet Map container) -->
    <!-- Passes JSON representation of destinations to the external map.js -->
    <div id="map-canvas" class="map-page-canvas" 
         data-destinations='<?= json_encode(array_map(function($d) {
             return [
                 'id' => $d['id'],
                 'name' => $d['name'],
                 'slug' => $d['slug'],
                 'latitude' => $d['latitude'],
                 'longitude' => $d['longitude'],
                 'description' => $d['description'],
                 'baseUrl' => base_url()
             ];
         }, $destinations)) ?>'>
    </div>

    <!-- Sidebar Destination Drawer -->
    <aside class="map-sidebar">
        <div class="map-sidebar-header">
            <h2>Jelajahi Destinasi Pantai</h2>
            <p>Pilih pantai dari daftar di bawah untuk memfokuskan lokasi di peta dan melihat informasi detail.</p>
        </div>
        <div class="map-sidebar-list">
            <?php foreach ($destinations as $dest): ?>
                <div class="map-sidebar-card reveal" 
                     data-id="<?= esc($dest['id']) ?>" 
                     data-lat="<?= esc($dest['latitude']) ?>" 
                     data-lng="<?= esc($dest['longitude']) ?>">
                    <h3><?= esc($dest['name']) ?></h3>
                    <p><?= esc($dest['description']) ?></p>
                    
                    <div class="map-card-meta">
                        <span class="meta-label">Rating: <?= esc($dest['rating'] ?? '4.7') ?> ★</span>
                        <span class="meta-label">Tiket: <?= $dest['ticket_price'] > 0 ? 'Rp ' . number_format($dest['ticket_price'], 0, ',', '.') : 'Gratis' ?></span>
                    </div>
                    
                    <a href="<?= base_url('destinations/' . $dest['slug']) ?>" class="btn btn-primary" style="margin-top: 1rem; width: 100%; font-size: 0.88rem; padding: 10px 16px; background: linear-gradient(135deg, var(--color-primary), #0d9488); color: #ffffff; font-weight: 700; border-radius: 8px;">
                        Lihat Detail &rarr;
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </aside>
</main>

<?= view('layouts/scripts') ?>
