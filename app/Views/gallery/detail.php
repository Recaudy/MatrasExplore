<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>

<section class="section-padding" style="padding-top: 8rem; background-color: var(--color-light);">
    <div class="container">
        <a href="<?= base_url('gallery') ?>" class="card-link" style="display: inline-flex; align-items: center; gap: 8px; margin-bottom: 2rem; font-weight: 700; color: var(--color-primary);">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="18" height="18" style="transform: rotate(180deg);">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
            Back to gallery collage
        </a>
        
        <div class="gallery-detail-container reveal active">
            <div class="gallery-detail-img">
                <img src="<?= base_url($item['image']) ?>" alt="<?= esc($item['title']) ?>">
            </div>
            <div class="gallery-detail-content">
                <span class="badge-category" style="margin-bottom: 1rem;">Visual Journal Frame</span>
                <h1 class="gallery-detail-title"><?= esc($item['title']) ?></h1>
                <p class="gallery-detail-desc"><?= esc($item['description']) ?></p>
                
                <div class="gallery-detail-meta">
                    <span style="font-size: 0.9rem; color: var(--color-dark-muted);">Shot captured on Bangka Island</span>
                    <?php if (isset($item['destination_slug']) && !empty($item['destination_slug'])): ?>
                        <a href="<?= base_url('destinations/' . $item['destination_slug']) ?>" class="btn btn-dark">Explore Destination</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?= view('layouts/footer') ?>
<?= view('layouts/scripts') ?>
