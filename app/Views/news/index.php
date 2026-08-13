<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>

<!-- News Header -->
<section class="page-header">
    <div class="container text-center">
        <h1 style="margin-bottom: 1rem;">Berita & Artikel</h1>
        <p class="page-header-desc">Ikuti perkembangan terbaru, kegiatan, dan cerita menarik dari kawasan Desa Wisata Matras.</p>
    </div>
</section>

<!-- News List Section -->
<section style="padding: 80px 0;">
    <div class="container">
        <?php if (empty($news)): ?>
            <div style="text-align: center; padding: 50px 20px; background: white; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 1rem;"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                <h3 style="color: #64748b;">Belum ada berita.</h3>
            </div>
        <?php else: ?>
            <div id="newsPageGrid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px;">
                <?php foreach ($news as $index => $item): ?>
                    <a href="<?= base_url('news/' . $item['slug']) ?>" class="news-page-card" <?= $index >= 9 ? 'style="display: none;" data-hidden="true"' : 'style="display: block;"' ?> style="text-decoration: none; color: inherit; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.1)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.05)';">
                        <div style="height: 220px; width: 100%; overflow: hidden;">
                            <img src="<?= base_url($item['image']) ?>" alt="<?= esc($item['title']) ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        </div>
                        <div style="padding: 24px;">
                            <div style="font-size: 0.85rem; color: var(--color-primary); font-weight: 600; margin-bottom: 8px;">
                                <?= date('d F Y', strtotime($item['created_at'])) ?>
                            </div>
                            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1e293b; margin-bottom: 12px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                <?= esc($item['title']) ?>
                            </h3>
                            <p style="color: #64748b; font-size: 0.95rem; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; margin: 0;">
                                <?= strip_tags($item['content']) ?>
                            </p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
            
            <?php if (count($news) > 9): ?>
            <div style="text-align: center; margin-top: 3rem;">
                <button id="btnLoadMoreNewsPage" class="btn btn-outline-primary" style="font-weight: 700; padding: 12px 32px; border-radius: 50px;">
                    Tampilkan Lebih Banyak
                </button>
            </div>
            
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const btnLoadMore = document.getElementById('btnLoadMoreNewsPage');
                if (btnLoadMore) {
                    btnLoadMore.addEventListener('click', function() {
                        const hiddenItems = document.querySelectorAll('#newsPageGrid .news-page-card[data-hidden="true"]');
                        const itemsToShow = 9;
                        
                        if (hiddenItems.length === 0) {
                            btnLoadMore.style.display = 'none';
                            return;
                        }
                        
                        for (let i = 0; i < itemsToShow && i < hiddenItems.length; i++) {
                            hiddenItems[i].style.display = 'block';
                            hiddenItems[i].removeAttribute('data-hidden');
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
