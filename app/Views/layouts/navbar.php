<!-- Explore Bangka Beaches - Navbar Layout Component -->
<?php
$isHome = url_is('/');
?>
<header class="header-nav <?= $isHome ? 'home-page' : 'interior-page' ?>">
    <div class="container nav-container">
        <!-- Logo -->
        <a href="<?= $isHome ? '#dashboard' : base_url('#dashboard') ?>" class="logo">
            <div>DesaWisata<span class="highlight">Matras</span></div>
        </a>

        <!-- Desktop Navigation Menu -->
        <nav>
            <ul class="nav-menu" id="nav-menu">
                <li>
                    <a href="<?= $isHome ? '#destinations' : base_url('#destinations') ?>" class="nav-link"
                        data-section="destinations">Destinations</a>
                </li>
                <li>
                    <a href="<?= $isHome ? '#gallery' : base_url('#gallery') ?>" class="nav-link"
                        data-section="gallery">Gallery</a>
                </li>
                <li>
                    <a href="<?= $isHome ? '#shorts' : base_url('#shorts') ?>" class="nav-link <?= url_is('shorts') ? 'active' : '' ?>" data-section="shorts">Shorts</a>
                </li>
                <li>
                    <a href="<?= $isHome ? '#informasi' : base_url('#informasi') ?>" class="nav-link" data-section="informasi">Informasi</a>
                </li>
                <li>
                    <a href="<?= $isHome ? '#map' : base_url('#map') ?>" class="nav-link" data-section="map">Map</a>
                </li>
                <li>
                    <a href="<?= $isHome ? '#contact' : base_url('#contact') ?>" class="nav-link"
                        data-section="contact">Contact</a>
                </li>

            </ul>
        </nav>

        <!-- Mobile Navigation Menu Toggle Button -->
        <button class="mobile-toggle" id="mobile-toggle" aria-label="Toggle menu navigation drawer">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>
    </div>
</header>