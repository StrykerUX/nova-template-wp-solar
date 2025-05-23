/**
 * Nova Solar Theme - Main JavaScript
 */

(function($) {
    'use strict';

    // Theme object
    const NovaSolar = {
        // Initialize
        init: function() {
            this.bindEvents();
            this.initThemeMode();
            this.initSidebar();
            this.initMobileNav();
            this.initTooltips();
        },

        // Bind events
        bindEvents: function() {
            // Theme switcher
            $(document).on('click', '.theme-btn', this.handleThemeSwitch.bind(this));
            
            // Sidebar toggle
            $(document).on('click', '#sidebarToggle', this.toggleSidebar.bind(this));
            
            // Mobile menu toggle
            $(document).on('click', '#mobileMenuToggle', this.toggleMobileMenu.bind(this));
            
            // Sidebar overlay click
            $(document).on('click', '.sidebar-overlay', this.closeMobileMenu.bind(this));
            
            // Window resize
            $(window).on('resize', this.handleResize.bind(this));
        },

        // Initialize theme mode
        initThemeMode: function() {
            const savedTheme = this.getCookie('nova_theme_mode') || 'dark';
            this.setThemeMode(savedTheme, false);
        },

        // Handle theme switch
        handleThemeSwitch: function(e) {
            e.preventDefault();
            const $btn = $(e.currentTarget);
            const theme = $btn.data('theme');
            
            if (theme) {
                this.setThemeMode(theme, true);
            }
        },

        // Set theme mode
        setThemeMode: function(mode, save = true) {
            // Add transitioning class
            $('body').addClass('theme-transitioning');
            
            // Remove existing theme classes and add new one
            $('body').removeClass('theme-dark theme-light').addClass('theme-' + mode);
            
            // Update active button
            $('.theme-btn').removeClass('active');
            $('.theme-btn[data-theme="' + mode + '"]').addClass('active');
            
            // Remove transitioning class after animation
            setTimeout(() => {
                $('body').removeClass('theme-transitioning');
            }, 500);
            
            // Save preference
            if (save) {
                this.saveThemeMode(mode);
            }
        },

        // Save theme mode via AJAX
        saveThemeMode: function(mode) {
            $.ajax({
                url: novaSolar.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'nova_save_theme_mode',
                    mode: mode,
                    nonce: novaSolar.nonce
                },
                success: function(response) {
                    console.log('Theme mode saved:', mode);
                },
                error: function(error) {
                    console.error('Error saving theme mode:', error);
                }
            });
        },

        // Initialize sidebar
        initSidebar: function() {
            // Check if sidebar should be collapsed on load
            const isCollapsed = this.getCookie('nova_sidebar_collapsed') === 'true';
            if (isCollapsed) {
                $('.dashboard-sidebar').addClass('is-collapsed');
            }
        },

        // Toggle sidebar
        toggleSidebar: function(e) {
            e.preventDefault();
            const $sidebar = $('.dashboard-sidebar');
            $sidebar.toggleClass('is-collapsed');
            
            // Save state
            const isCollapsed = $sidebar.hasClass('is-collapsed');
            this.setCookie('nova_sidebar_collapsed', isCollapsed, 30);
        },

        // Initialize mobile navigation
        initMobileNav: function() {
            // Create overlay if it doesn't exist
            if (!$('.sidebar-overlay').length) {
                $('<div class="sidebar-overlay"></div>').appendTo('body');
            }
        },

        // Toggle mobile menu
        toggleMobileMenu: function(e) {
            e.preventDefault();
            const $sidebar = $('.dashboard-sidebar');
            const $overlay = $('.sidebar-overlay');
            const $toggle = $('#mobileMenuToggle');
            
            $sidebar.toggleClass('is-open');
            $overlay.toggleClass('is-visible');
            $toggle.toggleClass('is-active');
            
            // Prevent body scroll when menu is open
            if ($sidebar.hasClass('is-open')) {
                $('body').css('overflow', 'hidden');
            } else {
                $('body').css('overflow', '');
            }
        },

        // Close mobile menu
        closeMobileMenu: function() {
            $('.dashboard-sidebar').removeClass('is-open');
            $('.sidebar-overlay').removeClass('is-visible');
            $('#mobileMenuToggle').removeClass('is-active');
            $('body').css('overflow', '');
        },

        // Handle window resize
        handleResize: function() {
            // Close mobile menu on desktop
            if (window.innerWidth >= 992) {
                this.closeMobileMenu();
            }
        },

        // Initialize tooltips
        initTooltips: function() {
            // Add tooltip functionality if needed
            $('[data-tooltip]').each(function() {
                const $this = $(this);
                const tooltip = $this.data('tooltip');
                
                $this.on('mouseenter', function() {
                    const $tooltip = $('<div class="tooltip">' + tooltip + '</div>');
                    $('body').append($tooltip);
                    
                    const offset = $this.offset();
                    $tooltip.css({
                        top: offset.top - $tooltip.outerHeight() - 10,
                        left: offset.left + ($this.outerWidth() / 2) - ($tooltip.outerWidth() / 2)
                    }).addClass('show');
                }).on('mouseleave', function() {
                    $('.tooltip').remove();
                });
            });
        },

        // Cookie helpers
        setCookie: function(name, value, days) {
            const expires = new Date();
            expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
            document.cookie = name + '=' + value + ';expires=' + expires.toUTCString() + ';path=/';
        },

        getCookie: function(name) {
            const nameEQ = name + '=';
            const ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) === ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }
    };

    // Document ready
    $(document).ready(function() {
        NovaSolar.init();
    });

    // Make NovaSolar available globally
    window.NovaSolar = NovaSolar;

})(jQuery);
