// Mobile-specific JavaScript
(function() {
    'use strict';

    // Check if mobile
    const isMobile = () => window.matchMedia('(max-width: 767px)').matches;

    // Initialize mobile features
    function initMobile() {
        if (!isMobile()) return;

        // Handle mobile menu toggle
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        if (mobileMenuToggle) {
            mobileMenuToggle.addEventListener('click', () => {
                const isOpen = sidebar.classList.contains('open');
                
                if (isOpen) {
                    sidebar.classList.remove('open');
                    overlay.classList.remove('active');
                    document.body.classList.remove('sidebar-open');
                } else {
                    sidebar.classList.add('open');
                    overlay.classList.add('active');
                    document.body.classList.add('sidebar-open');
                }
            });
        }

        // Close sidebar when clicking overlay
        if (overlay) {
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
                document.body.classList.remove('sidebar-open');
            });
        }
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMobile);
    } else {
        initMobile();
    }

})();