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
                                <img style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.85; transition: opacity 0.3s;" src="https://i.ytimg.com/vi/<?= $youtube_id ?>/maxresdefault.jpg" alt="<?= esc($short['title']) ?>" onerror="this.src='https://i.ytimg.com/vi/<?= $youtube_id ?>/hqdefault.jpg';">
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 50px; height: 50px; background: rgba(0,0,0,0.6); border-radius: 50%; display: flex; align-items: center; justify-content: center; z-index: 5; border: 2px solid rgba(255,255,255,0.8);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="white" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 3px;"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                                </div>
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
let currentYoutubeId = '';

function openVideoModal(title, youtubeId, description) {
    currentYoutubeId = youtubeId;
    const modalTitle = document.getElementById('modalVideoTitle');
    const modalDesc = document.getElementById('modalVideoDesc');
    const btnReadMore = document.getElementById('btnReadMore');
    const modal = document.getElementById('videoModalPopup');

    if(modalTitle) modalTitle.textContent = title;
    
    if(modalDesc) {
        modalDesc.textContent = description || '';
        modalDesc.style.webkitLineClamp = '2';
        modalDesc.style.maxHeight = 'none';
        modalDesc.style.overflowY = 'hidden';
        modalDesc.style.paddingRight = '0';
        
        const btnOpenYoutube = document.getElementById('btnOpenYoutube');
        if(btnOpenYoutube) {
            btnOpenYoutube.href = 'https://www.youtube.com/shorts/' + youtubeId;
        }

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
    
    // Show the modal with fallback thumbnail first
    const wrapper = document.getElementById('ytPlayerWrapper');
    const fallback = document.getElementById('ytFallback');
    const iframeContainer = document.getElementById('ytIframeContainer');
    
    if (wrapper) {
        // Show fallback thumbnail immediately as background
        if (fallback) {
            fallback.querySelector('img').src = 'https://i.ytimg.com/vi/' + youtubeId + '/maxresdefault.jpg';
            fallback.querySelector('img').onerror = function() { this.src = 'https://i.ytimg.com/vi/' + youtubeId + '/hqdefault.jpg'; };
            fallback.querySelector('a').href = 'https://www.youtube.com/shorts/' + youtubeId;
            fallback.style.display = 'none'; // hide initially, show only if iframe fails
        }
        
        // Try iframe embed
        if (iframeContainer) {
            iframeContainer.style.display = 'block';
            iframeContainer.innerHTML = '<iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;" src="https://www.youtube.com/embed/' + youtubeId + '?autoplay=1&modestbranding=1&rel=0&playsinline=1" title="Video" frameborder="0" referrerpolicy="strict-origin-when-cross-origin" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
            
            // Check after 4 seconds if video loaded — if iframe threw Error 153, YouTube shows error UI inside iframe
            // We can't detect that from parent, so we provide a manual "not working?" link
        }
    }
    
    if(modal) {
        modal.style.display = 'flex';
        
        setTimeout(() => {
            modal.style.opacity = '1';
            const box = modal.querySelector('.video-modal-box');
            if(box) box.style.transform = 'scale(1)';
            
            if (modalDesc && description && description.trim() !== '') {
                if (modalDesc.scrollHeight > (modalDesc.clientHeight + 2) || description.length > 90) {
                    if (btnReadMore) btnReadMore.style.display = 'inline-block';
                }
            }
        }, 50);
    }
}

function switchToFallback() {
    const fallback = document.getElementById('ytFallback');
    const iframeContainer = document.getElementById('ytIframeContainer');
    
    if (iframeContainer) {
        iframeContainer.style.display = 'none';
        iframeContainer.innerHTML = '';
    }
    if (fallback) {
        fallback.style.display = 'flex';
    }
}

function closeVideoModal() {
    const modal = document.getElementById('videoModalPopup');
    
    if(modal) {
        modal.style.opacity = '0';
        const box = modal.querySelector('.video-modal-box');
        if(box) box.style.transform = 'scale(0.95)';
        
        setTimeout(() => {
            modal.style.display = 'none';
            const iframeContainer = document.getElementById('ytIframeContainer');
            if (iframeContainer) iframeContainer.innerHTML = '';
            const fallback = document.getElementById('ytFallback');
            if (fallback) fallback.style.display = 'none';
        }, 300);
    }
}

function toggleDesc() {
    const modalDesc = document.getElementById('modalVideoDesc');
    const btnReadMore = document.getElementById('btnReadMore');
    
    if (modalDesc.style.display === '-webkit-box' || modalDesc.style.webkitLineClamp === '2') {
        modalDesc.style.display = 'block';
        modalDesc.style.webkitLineClamp = 'unset';
        modalDesc.style.maxHeight = '65vh'; 
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
        
        <!-- Close Button -->
        <button type="button" onclick="closeVideoModal()" style="position: absolute; top: 1rem; right: 1rem; background: rgba(0,0,0,0.7); border: 1px solid rgba(255,255,255,0.2); font-size: 1.8rem; cursor: pointer; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; z-index: 10010; transition: all 0.2s; backdrop-filter: blur(4px);" onmouseover="this.style.background='rgba(0,0,0,0.9)'; this.style.transform='scale(1.1)';" onmouseout="this.style.background='rgba(0,0,0,0.7)'; this.style.transform='scale(1)';">&times;</button>

        <div id="ytPlayerWrapper" class="video-container" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: #000;">
            <!-- Iframe container (shown first) -->
            <div id="ytIframeContainer" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></div>
            
            <!-- Fallback UI (shown when iframe fails) -->
            <div id="ytFallback" style="display: none; position: absolute; top: 0; left: 0; width: 100%; height: 100%; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 20px;">
                <img src="" alt="Thumbnail" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.4; filter: blur(2px);">
                <div style="position: relative; z-index: 2;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 20px; opacity: 0.9;"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                    <h4 style="color: white; margin-bottom: 10px; font-family: 'Outfit', sans-serif; font-size: 1.15rem;">Video Tidak Dapat Diputar di Sini</h4>
                    <p style="color: #ccc; font-size: 0.9rem; margin-bottom: 25px; line-height: 1.5; max-width: 280px;">Pemilik video membatasi pemutaran di website eksternal. Klik tombol di bawah untuk menonton di YouTube.</p>
                    <a href="#" target="_blank" style="display: inline-flex; align-items: center; gap: 8px; background: #ff0000; color: white; padding: 12px 24px; border-radius: 25px; text-decoration: none; font-weight: bold; font-size: 0.95rem; transition: all 0.2s; box-shadow: 0 4px 15px rgba(255,0,0,0.4);" onmouseover="this.style.background='#cc0000'; this.style.transform='scale(1.05)';" onmouseout="this.style.background='#ff0000'; this.style.transform='scale(1)';">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33 2.78 2.78 0 0 0 1.94 2c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.33 29 29 0 0 0-.46-5.33z"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="white"/></svg>
                        Tonton di YouTube
                    </a>
                </div>
            </div>
        </div>
        
        <!-- "Video tidak muncul?" link -->
        <div style="position: absolute; top: 1rem; left: 1rem; z-index: 10010;">
            <button type="button" onclick="switchToFallback()" style="background: rgba(0,0,0,0.6); backdrop-filter: blur(4px); border: 1px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.7); font-size: 0.75rem; padding: 5px 10px; border-radius: 15px; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.color='white'; this.style.background='rgba(0,0,0,0.8)';" onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.background='rgba(0,0,0,0.6)';">Video tidak muncul?</button>
        </div>
        
        <!-- Description Overlay -->
        <div id="videoOverlay" style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 6rem 1.25rem 1.5rem; color: white; z-index: 10; pointer-events: none;">
            <div style="pointer-events: auto;">
                <h3 id="modalVideoTitle" style="font-size: 1.05rem; font-weight: bold; color: #ffffff; margin: 0 0 0.5rem; text-shadow: 1px 1px 3px rgba(0,0,0,0.9); letter-spacing: 0.5px;">Judul Video</h3>
                
                <div id="descWrapper">
                    <p id="modalVideoDesc" style="font-size: 1.05rem; font-weight: normal; color: #ffffff; margin: 0; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-shadow: 1px 1px 3px rgba(0,0,0,0.9); transition: all 0.3s ease; white-space: pre-wrap; word-break: break-word; overflow-wrap: anywhere; scrollbar-width: thin; scrollbar-color: rgba(255,255,255,0.3) transparent;"></p>
                    <div style="display: flex; gap: 10px; align-items: center; margin-top: 10px; flex-wrap: wrap;">
                        <button id="btnReadMore" type="button" onclick="toggleDesc()" style="background: none; border: none; color: #fff; font-size: 0.95rem; font-weight: 800; padding: 0; cursor: pointer; text-shadow: 1px 1px 3px rgba(0,0,0,0.9); display: none;">Lihat lebih banyak</button>
                        <a id="btnOpenYoutube" href="#" target="_blank" style="display: inline-flex; align-items: center; gap: 6px; background: rgba(255,255,255,0.2); backdrop-filter: blur(4px); color: white; padding: 6px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; text-decoration: none; border: 1px solid rgba(255,255,255,0.3); transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                                <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33 2.78 2.78 0 0 0 1.94 2c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.33 29 29 0 0 0-.46-5.33z"/>
                                <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="white"/>
                            </svg>
                            Buka di YouTube
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('layouts/footer') ?>
<?= view('layouts/scripts') ?>
