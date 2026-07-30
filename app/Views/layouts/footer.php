<?php
$isHome = url_is('/');
?>
<!-- Explore Bangka Beaches - Footer Layout Component -->
<footer class="footer-section">
    <div class="container">
        <div class="footer-grid">
            <!-- Brand Column -->
            <div class="footer-col-brand">
                <a href="<?= $isHome ? '#dashboard' : base_url('/') ?>" class="footer-logo">
                    <div>Explore<span class="highlight">Matras</span></div>
                </a>
                <p class="footer-desc">
                    Menjelajahi pesona Kawasan Wisata Pantai Matras dengan keindahan pesisir, suasana yang menenangkan, dan berbagai pengalaman wisata yang membuat setiap kunjungan semakin berkesan.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="footer-col">
                <h4>MENU UTAMA</h4>
                <ul class="footer-links">
                    <li><a href="<?= $isHome ? '#dashboard' : base_url('#dashboard') ?>">Dashboard</a></li>
                    <li><a href="<?= $isHome ? '#destinations' : base_url('#destinations') ?>">Destinations</a></li>
                    <li><a href="<?= $isHome ? '#gallery' : base_url('#gallery') ?>">Gallery</a></li>
                    <li><a href="<?= $isHome ? '#informasi' : base_url('#informasi') ?>">Informasi</a></li>
                    <li><a href="<?= $isHome ? '#map' : base_url('#map') ?>">Map</a></li>
                    <li><a href="<?= $isHome ? '#contact' : base_url('#contact') ?>">Contact</a></li>
                </ul>
            </div>

            <!-- Popular Shores -->
            <div class="footer-col">
                <h4>PANTAI </h4>
                <ul class="footer-links">
                    <li><a href="<?= base_url('destinations/pantai-matras') ?>">Pantai Matras</a></li>
                    <li><a href="<?= base_url('destinations/pantai-jambosag') ?>">Pantai Jambosag</a></li>
                    <li><a href="<?= base_url('destinations/pantai-turun-aban') ?>">Pantai Turun Aban</a></li>
                </ul>
            </div>
        </div>

        <!-- Bottom Copyright Bar -->
        <div class="footer-bottom">
            <div class="footer-copyright">
                &copy; <?= date('Y') ?> Explore Matras. Semua Hak Dilindungi.
            </div>
            <div class="footer-tagline">
                Jelajahi keindahan alam & Jaga kelestarian pantai
            </div>
        </div>
    </div>
</footer>

<!-- Floating Back to Top Button -->
<button class="back-to-top" id="back-to-top" aria-label="Scroll back to top">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="12" y1="19" x2="12" y2="5"></line>
        <polyline points="5 12 12 5 19 12"></polyline>
    </svg>
</button>
