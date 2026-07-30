/* Explore Bangka Beaches - Navbar UI & Smooth Scroll Navigation Script */

document.addEventListener('DOMContentLoaded', () => {
    const navbar = document.querySelector('.header-nav');
    const mobileToggle = document.getElementById('mobile-toggle');
    const navMenu = document.getElementById('nav-menu');
    
    // Sticky Scroll Effect
    if (navbar) {
        const checkScroll = () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        };
        
        // Run on initial load and on scroll
        checkScroll();
        window.addEventListener('scroll', checkScroll);
    }
    
    // Mobile Navigation Drawer Toggle
    const resetMobileIcon = () => {
        if (mobileToggle) {
            mobileToggle.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            `;
        }
    };

    if (mobileToggle && navMenu) {
        mobileToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            navMenu.classList.toggle('active');
            
            if (navMenu.classList.contains('active')) {
                // Change to close (X) icon
                mobileToggle.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="var(--color-dark)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                `;
            } else {
                resetMobileIcon();
            }
        });
        
        // Close menu drawer if clicking outside
        document.addEventListener('click', (e) => {
            if (navMenu.classList.contains('active') && !navMenu.contains(e.target) && !mobileToggle.contains(e.target)) {
                navMenu.classList.remove('active');
                resetMobileIcon();
            }
        });
    }

    // Smooth Scroll for Anchor Navigation Links (#destinations, #gallery, #map, #contact, #dashboard)
    const anchorLinks = document.querySelectorAll('a[href*="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (!href || href === '#' || href === '#!') return;

            // Extract hash e.g. "#destinations"
            const hashIndex = href.indexOf('#');
            if (hashIndex !== -1) {
                const hash = href.substring(hashIndex);
                const targetElement = document.querySelector(hash);

                // If target element exists on this page, scroll smoothly
                if (targetElement) {
                    e.preventDefault();

                    // Close mobile nav drawer if open
                    if (navMenu && navMenu.classList.contains('active')) {
                        navMenu.classList.remove('active');
                        resetMobileIcon();
                    }

                    const navHeight = navbar ? navbar.offsetHeight : 80;
                    const elementPosition = targetElement.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - navHeight;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });

                    // Update active nav-link manually on click
                    const navLinks = document.querySelectorAll('.nav-menu .nav-link');
                    navLinks.forEach(nl => nl.classList.remove('active'));
                    if (this.classList.contains('nav-link')) {
                        this.classList.add('active');
                    } else {
                        const sectionName = hash.replace('#', '');
                        const correspondingNavLink = document.querySelector(`.nav-menu .nav-link[data-section="${sectionName}"]`);
                        if (correspondingNavLink) correspondingNavLink.classList.add('active');
                    }
                }
            }
        });
    });

    // ScrollSpy: Dynamic active link highlighting as user scrolls on home page
    const sections = document.querySelectorAll('section[id]');
    if (sections.length > 0) {
        window.addEventListener('scroll', () => {
            const navHeight = navbar ? navbar.offsetHeight : 80;
            let currentSection = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop - navHeight - 120;
                const sectionHeight = section.offsetHeight;
                if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
                    currentSection = section.getAttribute('id');
                }
            });

            if (currentSection) {
                const navLinks = document.querySelectorAll('.nav-menu .nav-link');
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('data-section') === currentSection) {
                        link.classList.add('active');
                    }
                });
            }
        });
    }
});
