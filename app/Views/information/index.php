<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>

<!-- Information Header -->
<section class="page-header">
    <div class="container text-center">
        <h1 style="margin-bottom: 1rem;">Harga Sewa & Fasilitas</h1>
        <p class="page-header-desc">Temukan informasi terkait daftar harga sewa, fasilitas, aturan, dan panduan lainnya seputar Pantai Matras. Klik pada gambar untuk memperbesar.</p>
    </div>
</section>

<!-- Information Listing Grid (Square 1:1 Aspect Ratio) -->
<section class="section-padding">
    <div class="container">
        <?php if (empty($information)): ?>
            <div class="text-center" style="padding: 3rem 0; color: var(--color-dark-muted);">
                <p>Belum ada informasi yang tersedia saat ini.</p>
            </div>
        <?php else: ?>
            <?php 
            $infoCount = count($information);
            $gridCols = $infoCount >= 4 ? 4 : $infoCount;
            $maxWidth = $infoCount == 1 ? '300px' : ($infoCount == 2 ? '600px' : ($infoCount == 3 ? '850px' : '1000px'));
            ?>
            <style>
                #infoPageGrid {
                    display: grid;
                    grid-template-columns: repeat(<?= $gridCols ?>, 1fr);
                    gap: 1.75rem;
                    max-width: <?= $maxWidth ?>;
                    margin: 0 auto;
                }
                #infoPageGrid .gallery-page-card {
                    aspect-ratio: 3 / 4 !important; /* Persegi panjang (Portrait) */
                }
                @media (max-width: 992px) {
                    #infoPageGrid {
                        grid-template-columns: repeat(<?= min(2, $gridCols) ?>, 1fr) !important;
                        gap: 20px !important;
                    }
                    #infoPageGrid .gallery-page-card {
                        border-radius: var(--border-radius-lg) !important;
                        overflow: hidden !important;
                        height: auto !important;
                        width: 100% !important;
                    }
                }
                @media (max-width: 576px) {
                    #infoPageGrid {
                        grid-template-columns: repeat(<?= min(2, $gridCols) ?>, 1fr) !important;
                    }
                }
            </style>
            <div id="infoPageGrid">
                <?php foreach ($information as $index => $item): ?>
                    <div class="gallery-card gallery-page-card reveal" 
                         data-lightbox 
                         data-title="<?= esc($item['title']) ?>" 
                         data-desc="<?= esc($item['description'] ?? '') ?>"
                         <?= $index >= 8 ? 'style="display: none;" data-hidden="true"' : '' ?>>
                        <img src="<?= base_url($item['image_path']) ?>" alt="<?= esc($item['title']) ?>">
                        <div class="gallery-overlay">
                            <h4><?= esc($item['title']) ?></h4>
                            <p style="font-size: 0.8rem; opacity: 0.9; margin-top: 4px;">Klik untuk memperbesar</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <?php if (count($information) > 8): ?>
            <div style="text-align: center; margin-top: 3rem;">
                <button id="btnLoadMoreInfoPage" class="btn btn-outline-primary" style="font-weight: 700; padding: 12px 32px; border-radius: 50px;">
                    Tampilkan Lebih Banyak
                </button>
            </div>
            
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const btnLoadMore = document.getElementById('btnLoadMoreInfoPage');
                if (btnLoadMore) {
                    btnLoadMore.addEventListener('click', function() {
                        const hiddenItems = document.querySelectorAll('#infoPageGrid .gallery-page-card[data-hidden="true"]');
                        const itemsToShow = 8;
                        
                        if (hiddenItems.length === 0) {
                            btnLoadMore.style.display = 'none';
                            return;
                        }
                        
                        for (let i = 0; i < itemsToShow && i < hiddenItems.length; i++) {
                            hiddenItems[i].style.display = 'block';
                            hiddenItems[i].removeAttribute('data-hidden');
                            
                            setTimeout(() => {
                                hiddenItems[i].classList.add('active');
                            }, 50 * i);
                        }

                        if (hiddenItems.length <= itemsToShow) {
                            btnLoadMore.style.display = 'none';
                        }
                    });
                }
            });
            </script>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<?= view('layouts/footer') ?>
<?= view('layouts/scripts') ?>
