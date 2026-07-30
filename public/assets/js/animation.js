/* Explore Bangka Beaches - Scroll Animation Script */

document.addEventListener('DOMContentLoaded', () => {
    // Select all elements with the 'reveal' class
    const revealElements = document.querySelectorAll('.reveal');
    
    if (revealElements.length === 0) return;
    
    // Configure observer options
    const observerOptions = {
        root: null, // Viewport is the root
        threshold: 0.1, // Trigger when 10% of element is visible
        rootMargin: '0px 0px -50px 0px' // Offset bottom slightly for better UX
    };
    
    // Create the Intersection Observer instance
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                observer.unobserve(entry.target); // Stop observing once animated
            }
        });
    }, observerOptions);
    
    // Observe each element
    revealElements.forEach(element => {
        observer.observe(element);
    });
});
