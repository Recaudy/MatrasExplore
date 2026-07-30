/* Explore Bangka Beaches - Accommodation Slider Script */

document.addEventListener('DOMContentLoaded', () => {
    const sliderContainer = document.querySelector('.slider-container-wrapper');
    const slider = document.querySelector('.accommodation-slider');
    
    if (!sliderContainer || !slider) return;
    
    const cards = slider.querySelectorAll('.accommodation-card');
    if (cards.length === 0) return;
    
    // For our current homepage design, we display all 4 cards.
    // In mobile and tablet viewports, the CSS Grid wraps cards to 2 columns or 1 column.
    // We can add simple swipe/scroll snap indicators or smooth animations for scroll interfaces.
    // Here we implement touch swipe detection and horizontal scrolling indicators.
    
    let isDown = false;
    let startX;
    let scrollLeft;
    
    sliderContainer.addEventListener('mousedown', (e) => {
        isDown = true;
        sliderContainer.classList.add('active');
        startX = e.pageX - sliderContainer.offsetLeft;
        scrollLeft = sliderContainer.scrollLeft;
    });
    
    sliderContainer.addEventListener('mouseleave', () => {
        isDown = false;
        sliderContainer.classList.remove('active');
    });
    
    sliderContainer.addEventListener('mouseup', () => {
        isDown = false;
        sliderContainer.classList.remove('active');
    });
    
    sliderContainer.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - sliderContainer.offsetLeft;
        const walk = (x - startX) * 2; // scroll-fast multiplier
        sliderContainer.scrollLeft = scrollLeft - walk;
    });
});
