/**
 * Modern Header JavaScript
 * Handles search bar toggle and language selection
 */

document.addEventListener('DOMContentLoaded', function() {
    // Search Toggle Functionality
    const searchToggle = document.getElementById('searchToggle');
    const searchBar = document.getElementById('searchBar');

    if (searchToggle && searchBar) {
        searchToggle.addEventListener('click', function() {
            searchBar.classList.toggle('active');
            // Focus on search input when opened
            if (searchBar.classList.contains('active')) {
                const searchInput = searchBar.querySelector('.search-input');
                if (searchInput) {
                    setTimeout(() => searchInput.focus(), 100);
                }
            }
        });

        // Close search bar when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.search-toggle') && !event.target.closest('.search-bar-wrapper')) {
                searchBar.classList.remove('active');
            }
        });

        // Close search bar on ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && searchBar.classList.contains('active')) {
                searchBar.classList.remove('active');
            }
        });
    }

    // Language Selection (Desktop)
    const siteLanguageSelect = document.getElementById('site-language');
    if (siteLanguageSelect) {
        siteLanguageSelect.addEventListener('change', function() {
            changeLanguage(this.value);
        });
    }

    // Language Selection (Mobile)
    const siteLanguageMobileSelect = document.getElementById('site-language-mobile');
    if (siteLanguageMobileSelect) {
        siteLanguageMobileSelect.addEventListener('change', function() {
            changeLanguage(this.value);
        });
    }

    // Mobile Search Form Submission
    const mobileSearchForm = document.querySelector('.mobile-search-wrapper form');
    if (mobileSearchForm) {
        mobileSearchForm.addEventListener('submit', function() {
            // Optional: close offcanvas on search submit
            const offcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('offcanvasNavbar'));
            if (offcanvas) {
                offcanvas.hide();
            }
        });
    }

    // Navbar Toggler Animation
    const navbarToggler = document.querySelector('.navbar-toggler');
    if (navbarToggler) {
        navbarToggler.addEventListener('click', function() {
            this.classList.toggle('active');
        });
    }

    // Close offcanvas on link click
    const offcanvasLinks = document.querySelectorAll('[data-bs-dismiss="offcanvas"]');
    offcanvasLinks.forEach(link => {
        link.addEventListener('click', function() {
            const offcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('offcanvasNavbar'));
            if (offcanvas) {
                offcanvas.hide();
            }
        });
    });
});

/**
 * Change Language
 * Sends a request to change the site language
 */
function changeLanguage(lang) {
    const currentUrl = window.location.href;
    const url = new URL(currentUrl);
    
    // Set language parameter or redirect to language path
    window.location.href = `/language/${lang}`;
}

/**
 * Handle Navbar Dropdown on Hover (Desktop)
 */
document.addEventListener('DOMContentLoaded', function() {
    if (window.innerWidth > 991) {
        const dropdowns = document.querySelectorAll('.main-menu .dropdown');
        
        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('mouseenter', function() {
                const menu = this.querySelector('.dropdown-menu');
                if (menu) {
                    menu.classList.add('show');
                    this.querySelector('.dropdown-toggle').setAttribute('aria-expanded', 'true');
                }
            });

            dropdown.addEventListener('mouseleave', function() {
                const menu = this.querySelector('.dropdown-menu');
                if (menu) {
                    menu.classList.remove('show');
                    this.querySelector('.dropdown-toggle').setAttribute('aria-expanded', 'false');
                }
            });
        });
    }
});
