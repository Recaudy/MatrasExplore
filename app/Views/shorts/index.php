<?= view('layouts/header') ?>

<?= view('layouts/navbar') ?>

<main class="shorts-page">
    <!-- Shorts Header -->
    <section class="page-header">
        <div class="container text-center">
            <h1 style="margin-bottom: 1rem;">Kumpulan Video Shorts</h1>
            <p class="page-header-desc">Kumpulan momen dan pesona wisata Pantai Bangka dalam balutan video singkat.</p>
        </div>
    </section>

    <section class="shorts-section section-padding">
        <div class="container">
            <?php if(empty($shorts)): ?>
                <div class="empty-state text-center" style="padding: 4rem 0;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 1.5rem;"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                    <h3 style="color: var(--color-dark); font-family: 'Outfit', sans-serif;">Belum Ada Video</h3>
                    <p style="color: #64748b;">Video shorts belum tersedia saat ini. Silakan kembali lagi nanti.</p>
                </div>
            <?php else: ?>
                <div class="shorts-grid">
                    <?php foreach($shorts as $short): 
                        // Extract video ID from youtube url to embed
                        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?|shorts)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $short['youtube_url'], $matches);
                        $youtube_id = isset($matches[1]) ? $matches[1] : '';
                    ?>
                    <div class="short-card" style="border-radius: 16px; overflow: hidden; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.15); display: flex; flex-direction: column; transition: transform 0.3s ease; position: relative;">
                        <div class="video-container" style="position: relative; width: 100%; padding-bottom: 177.77%; background: #000; cursor: pointer;" onclick="openVideoModal('<?= esc($short['title'], 'js') ?>', '<?= esc($youtube_id, 'js') ?>', '<?= esc($short['description'] ?? '', 'js') ?>')">
                            <?php if($youtube_id): ?>
                                <iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none; pointer-events: none;" src="https://www.youtube.com/embed/<?= $youtube_id ?>?modestbranding=1&rel=0&iv_load_policy=3&controls=0&playsinline=1" title="<?= esc($short['title']) ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            <?php else: ?>
                                <div class="invalid-video">URL Video Tidak Valid</div>
                            <?php endif; ?>
                            
                            <div style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 4rem 1rem 1rem; background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.4) 60%, transparent 100%); pointer-events: none;">
                                <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.1rem; font-weight: bold; color: #ffffff; margin: 0; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-shadow: 1px 1px 3px rgba(0,0,0,0.8);"><?= esc($short['title']) ?></h3>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<script>
function openVideoModal(title, youtubeId, description) {
    const modalTitle = document.getElementById('modalVideoTitle');
    const modalDesc = document.getElementById('modalVideoDesc');
    const btnReadMore = document.getElementById('btnReadMore');
    const modalIframe = document.getElementById('modalVideoIframe');
    const modal = document.getElementById('videoModalPopup');

    if(modalTitle) modalTitle.textContent = title;
    
    if(modalDesc) {
        modalDesc.textContent = description || '';
        // Reset state
        modalDesc.style.webkitLineClamp = '2';
        modalDesc.style.maxHeight = 'none';
        modalDesc.style.overflowY = 'hidden';
        modalDesc.style.paddingRight = '0';
        if(btnReadMore) {
            btnReadMore.textContent = 'Lihat lebih banyak';
            btnReadMore.style.display = 'none';
        }
        
        if (description && description.trim() !== '') {
            modalDesc.style.display = '-webkit-box';
        } else {
            modalDesc.style.display = 'none';
        }
    }
    
    if(modalIframe) {
        modalIframe.src = 'https://www.youtube.com/embed/' + youtubeId + '?autoplay=1&modestbranding=1&rel=0';
    }
    
    if(modal) {
        modal.style.display = 'flex';
        
        // Wait for rendering to calculate scrollHeight accurately
        setTimeout(() => {
            modal.style.opacity = '1';
            const box = modal.querySelector('.video-modal-box');
            if(box) box.style.transform = 'scale(1)';
            
            // Now check if text overflows
            if (modalDesc && description && description.trim() !== '') {
                // Check if scrollHeight is significantly larger than clientHeight (to avoid subpixel issues)
                if (modalDesc.scrollHeight > (modalDesc.clientHeight + 2) || description.length > 90) {
                    if (btnReadMore) btnReadMore.style.display = 'inline-block';
                }
            }
        }, 50);
    }
}

function closeVideoModal() {
    const modal = document.getElementById('videoModalPopup');
    const modalIframe = document.getElementById('modalVideoIframe');
    
    if(modal) {
        modal.style.opacity = '0';
        const box = modal.querySelector('.video-modal-box');
        if(box) box.style.transform = 'scale(0.95)';
        
        setTimeout(() => {
            modal.style.display = 'none';
            if(modalIframe) modalIframe.src = '';
        }, 300); // match transition duration
    }
}

function toggleDesc() {
    const modalDesc = document.getElementById('modalVideoDesc');
    const btnReadMore = document.getElementById('btnReadMore');
    
    if (modalDesc.style.display === '-webkit-box' || modalDesc.style.webkitLineClamp === '2') {
        modalDesc.style.display = 'block';
        modalDesc.style.webkitLineClamp = 'unset';
        modalDesc.style.maxHeight = '65vh'; // Expand upwards significantly
        modalDesc.style.overflowY = 'auto';
        modalDesc.style.paddingRight = '10px';
        
        btnReadMore.textContent = 'Sembunyikan';
    } else {
        modalDesc.style.display = '-webkit-box';
        modalDesc.style.webkitLineClamp = '2';
        modalDesc.style.maxHeight = 'none';
        modalDesc.style.overflowY = 'hidden';
        modalDesc.style.paddingRight = '0';
        
        btnReadMore.textContent = 'Lihat lebih banyak';
        modalDesc.scrollTop = 0;
    }
}
</script>

<!-- Video Shorts Modal Popup (TikTok Style) -->
<div id="videoModalPopup" class="review-modal-backdrop" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999; background: rgba(0, 0, 0, 0.9); backdrop-filter: blur(6px); align-items: center; justify-content: center; padding: 0; opacity: 0; transition: opacity 0.3s ease;">
    
    <div class="video-modal-box" style="background: #000; width: 100%; max-width: 450px; height: 100%; max-height: 100vh; position: relative; display: flex; flex-direction: column; box-shadow: 0 0 50px rgba(0,0,0,0.5); transform: scale(0.95); transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);">
        
        <!-- Close Button Top Right (Inside Modal Box) -->
        <button type="button" onclick="closeVideoModal()" style="position: absolute; top: 1rem; right: 1rem; background: rgba(0,0,0,0.7); border: 1px solid rgba(255,255,255,0.2); font-size: 1.8rem; cursor: pointer; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; z-index: 10010; transition: all 0.2s; backdrop-filter: blur(4px);" onmouseover="this.style.background='rgba(0,0,0,0.9)'; this.style.transform='scale(1.1)';" onmouseout="this.style.background='rgba(0,0,0,0.7)'; this.style.transform='scale(1)';">&times;</button>

        <div class="video-container" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: #000;">
            <iframe id="modalVideoIframe" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;" src="" title="Video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
        
        <!-- Description Overlay -->
        <div id="videoOverlay" style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 6rem 1.25rem 1.5rem; color: white; z-index: 10; pointer-events: none;">
            <div style="pointer-events: auto;">
                <h3 id="modalVideoTitle" style="font-size: 1.05rem; font-weight: bold; color: #ffffff; margin: 0 0 0.5rem; text-shadow: 1px 1px 3px rgba(0,0,0,0.9); letter-spacing: 0.5px;">Judul Video</h3>
                
                <div id="descWrapper">
                    <p id="modalVideoDesc" style="font-size: 1.05rem; font-weight: normal; color: #ffffff; margin: 0; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-shadow: 1px 1px 3px rgba(0,0,0,0.9); transition: all 0.3s ease; white-space: pre-wrap; word-break: break-word; overflow-wrap: anywhere; /* Hide scrollbar for cleaner look */ scrollbar-width: thin; scrollbar-color: rgba(255,255,255,0.3) transparent;"></p>
                    <button id="btnReadMore" type="button" onclick="toggleDesc()" style="background: none; border: none; color: #fff; font-size: 1rem; font-weight: 800; padding: 0; margin-top: 8px; cursor: pointer; text-shadow: 1px 1px 3px rgba(0,0,0,0.9); display: none;">Lihat lebih banyak</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('layouts/footer') ?>
<?= view('layouts/scripts') ?>
