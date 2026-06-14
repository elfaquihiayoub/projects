/**
 * Hidden Spots Finder - Global client script
 * Premium UX and animations
 */

document.addEventListener('DOMContentLoaded', () => {
    initStickyHeader();
    initMobileNav();
    initScrollReveal();
    initRatingSelectors();
});

/**
 * 1. Sticky Frosted Glass Header
 */
function initStickyHeader() {
    const navbar = document.querySelector('.navbar');
    if (!navbar) return;

    const checkScroll = () => {
        if (window.scrollY > 20) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    };

    window.addEventListener('scroll', checkScroll);
    checkScroll(); // Initial check on load
}

/**
 * 2. Slide-out Mobile Navigation Drawer & Overlay
 */
function initMobileNav() {
    const toggleBtn = document.querySelector('.nav-toggle');
    const navLinks = document.querySelector('.nav-links');
    const overlay = document.querySelector('.nav-overlay');
    const body = document.body;

    if (!toggleBtn || !navLinks) return;

    const toggleMenu = (e) => {
        if (e) e.stopPropagation();
        toggleBtn.classList.toggle('active');
        navLinks.classList.toggle('active');
        if (overlay) overlay.classList.toggle('active');
        body.classList.toggle('drawer-open');
    };

    const closeMenu = () => {
        toggleBtn.classList.remove('active');
        navLinks.classList.remove('active');
        if (overlay) overlay.classList.remove('active');
        body.classList.remove('drawer-open');
    };

    toggleBtn.addEventListener('click', toggleMenu);
    if (overlay) {
        overlay.addEventListener('click', closeMenu);
    }

    // Close on escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeMenu();
    });
}

/**
 * 3. Intersection Observer Scroll Reveal Animation
 */
function initScrollReveal() {
    // Add reveal class to items we want to animate on scroll
    const selectors = [
        '.hero-content',
        '.hero-image-wrapper',
        '.category-card',
        '.discovery-card',
        '.place-card',
        '.section-header',
        '.cta-box',
        '.form-wrapper',
        '.page-header',
        '.review-item',
        '.profile-header'
    ];

    selectors.forEach(sel => {
        document.querySelectorAll(sel).forEach(el => {
            el.classList.add('reveal-item');
        });
    });

    const observerOptions = {
        root: null,
        rootMargin: '0px 0px -60px 0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                observer.unobserve(entry.target); // Animate only once
            }
        });
    }, observerOptions);

    document.querySelectorAll('.reveal-item').forEach(el => {
        observer.observe(el);
    });
}

/**
 * 4. Animated Tab Transitions (Cross-fade & Slide)
 */
window.showTab = function(tabName, eventObj) {
    const targetEvent = eventObj || window.event;
    const clickedTab = targetEvent ? targetEvent.currentTarget || targetEvent.target : null;

    const tabContents = document.querySelectorAll('.tab-content');
    const tabButtons = document.querySelectorAll('.tab');
    const targetContent = document.getElementById(tabName + '-tab');

    if (!targetContent) return;

    // Fade out visible tab contents
    tabContents.forEach(content => {
        if (content.style.display !== 'none' && content.id !== (tabName + '-tab')) {
            content.style.opacity = '0';
            content.style.transform = 'translateY(12px)';
            setTimeout(() => {
                content.style.display = 'none';
            }, 250);
        }
    });

    // Update active tab buttons
    tabButtons.forEach(btn => btn.classList.remove('active'));
    if (clickedTab) {
        clickedTab.classList.add('active');
    } else {
        // Fallback for programmatic calls
        tabButtons.forEach(btn => {
            if (btn.getAttribute('onclick') && btn.getAttribute('onclick').includes(tabName)) {
                btn.classList.add('active');
            }
        });
    }

    // Fade in target tab content
    setTimeout(() => {
        targetContent.style.display = 'block';
        // Force browser layout reflow
        targetContent.offsetHeight;
        targetContent.style.opacity = '1';
        targetContent.style.transform = 'translateY(0)';
    }, 260);
};

window.showTabPremium = window.showTab;

/**
 * 5. Star Rating Selector Hover Effects
 */
function initRatingSelectors() {
    const ratingContainer = document.querySelector('.stars-input');
    if (!ratingContainer) return;

    const labels = ratingContainer.querySelectorAll('label');
    const inputs = ratingContainer.querySelectorAll('input[type="radio"]');

    const highlightStars = (ratingValue) => {
        labels.forEach(label => {
            const val = parseInt(label.getAttribute('for').replace('star', ''), 10);
            if (val <= ratingValue) {
                label.classList.add('selected');
                label.classList.add('pulsing');
                setTimeout(() => label.classList.remove('pulsing'), 200);
            } else {
                label.classList.remove('selected');
            }
        });
    };

    labels.forEach(label => {
        label.addEventListener('click', () => {
            const val = parseInt(label.getAttribute('for').replace('star', ''), 10);
            highlightStars(val);
        });

        // Hover feedback
        label.addEventListener('mouseenter', () => {
            const hoverVal = parseInt(label.getAttribute('for').replace('star', ''), 10);
            labels.forEach(l => {
                const val = parseInt(l.getAttribute('for').replace('star', ''), 10);
                if (val <= hoverVal) {
                    l.classList.add('hovered');
                } else {
                    l.classList.remove('hovered');
                }
            });
        });
    });

    ratingContainer.addEventListener('mouseleave', () => {
        labels.forEach(l => l.classList.remove('hovered'));
    });

    // Initialize state
    inputs.forEach(input => {
        if (input.checked) {
            highlightStars(parseInt(input.value, 10));
        }
    });
}
