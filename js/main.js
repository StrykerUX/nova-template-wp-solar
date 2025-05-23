// Main JavaScript File
(function() {
    'use strict';

    // DOM Elements
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    const menuToggle = document.getElementById('menu-toggle');
    const themeDarkBtn = document.getElementById('theme-dark');
    const themeLightBtn = document.getElementById('theme-light');

    // State
    let isMobile = window.innerWidth < 768;
    let sidebarOpen = !isMobile;

    // Initialize
    function init() {
        // Set initial theme
        const savedTheme = localStorage.getItem('theme') || 'dark';
        setTheme(savedTheme);

        // Set initial sidebar state
        updateSidebarState();

        // Add event listeners
        addEventListeners();

        // Handle resize
        handleResize();
        
        // Set active navigation item based on current URL
        setActiveNavItem();
    }

    // Add Event Listeners
    function addEventListeners() {
        // Menu toggle button (top of sidebar)
        if (menuToggle) {
            menuToggle.addEventListener('click', toggleSidebar);
        }

        // Mobile menu toggle is handled in mobile.js
        // Sidebar overlay is handled in mobile.js

        // Theme toggles
        if (themeDarkBtn) {
            themeDarkBtn.addEventListener('click', () => setTheme('dark'));
        }

        if (themeLightBtn) {
            themeLightBtn.addEventListener('click', () => setTheme('light'));
        }

        // Window resize
        window.addEventListener('resize', debounce(handleResize, 250));

        // Navigation items - Let the links work naturally
        // Just handle visual active state updates
        const navItems = document.querySelectorAll('.nav-list a');
        navItems.forEach(link => {
            // Don't interfere with link navigation
            // Just update active states when clicked
            link.addEventListener('click', function(e) {
                // Get the parent li element
                const parentLi = this.closest('li');
                
                // Update active state in localStorage for persistence
                if (parentLi) {
                    const allLis = document.querySelectorAll('.nav-list li');
                    allLis.forEach((li, index) => {
                        if (li === parentLi) {
                            localStorage.setItem('activeNavItem', index);
                        }
                    });
                }
                
                // Close mobile sidebar after navigation (with delay)
                if (isMobile) {
                    setTimeout(() => {
                        if (typeof closeMobileSidebar === 'function') {
                            closeMobileSidebar();
                        }
                    }, 100);
                }
                // Let the link continue with its normal navigation
            });
        });

        // Bottom navigation items
        const bottomNavItems = document.querySelectorAll('.bottom-nav-item:not(#mobile-menu-toggle)');
        bottomNavItems.forEach(item => {
            item.addEventListener('click', handleBottomNavClick);
        });

        // User profile click
        const userProfile = document.querySelector('.user-profile');
        if (userProfile) {
            userProfile.addEventListener('click', handleUserProfileClick);
        }

        // Action button click
        const actionBtn = document.querySelector('.action-btn');
        if (actionBtn) {
            actionBtn.addEventListener('click', handleActionBtnClick);
        }
    }

    // Sidebar Functions
    function toggleSidebar() {
        if (!isMobile) {
            sidebarOpen = !sidebarOpen;
            sidebar.classList.toggle('closed', !sidebarOpen);
            mainContent.classList.toggle('sidebar-closed', !sidebarOpen);
            localStorage.setItem('sidebarOpen', sidebarOpen);
        }
    }

    // Mobile sidebar functions moved to mobile.js

    function updateSidebarState() {
        if (isMobile) {
            sidebar.classList.remove('closed');
            mainContent.classList.remove('sidebar-closed');
            // Mobile state is handled in mobile.js
        } else {
            const savedState = localStorage.getItem('sidebarOpen');
            sidebarOpen = savedState !== null ? savedState === 'true' : true;
            sidebar.classList.toggle('closed', !sidebarOpen);
            mainContent.classList.toggle('sidebar-closed', !sidebarOpen);
            sidebar.classList.remove('open');
            sidebarOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    // Theme Functions
    function setTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);

        // Update theme buttons
        themeDarkBtn.classList.toggle('active', theme === 'dark');
        themeLightBtn.classList.toggle('active', theme === 'light');
    }

    // Navigation Functions
    // Handled inline in addEventListeners to avoid preventing default link behavior
    
    // Set active navigation item based on current URL
    function setActiveNavItem() {
        const currentUrl = window.location.href;
        const navLinks = document.querySelectorAll('.nav-list a');
        
        // Remove all active classes first
        document.querySelectorAll('.nav-list li').forEach(li => {
            li.classList.remove('active');
        });
        
        // Find and set the active item
        navLinks.forEach(link => {
            if (link.href === currentUrl) {
                const parentLi = link.closest('li');
                if (parentLi) {
                    parentLi.classList.add('active');
                }
            }
        });
        
        // If no exact match, try to match by path
        if (!document.querySelector('.nav-list li.active')) {
            const currentPath = window.location.pathname;
            navLinks.forEach(link => {
                const linkPath = new URL(link.href).pathname;
                if (currentPath.startsWith(linkPath) && linkPath !== '/') {
                    const parentLi = link.closest('li');
                    if (parentLi) {
                        parentLi.classList.add('active');
                    }
                }
            });
        }
    }

    function handleBottomNavClick(e) {
        // Remove active class from all items
        document.querySelectorAll('.bottom-nav-item').forEach(item => {
            item.classList.remove('active');
        });

        // Add active class to clicked item
        e.currentTarget.classList.add('active');
    }

    // User Actions
    function handleUserProfileClick() {
        console.log('User profile clicked');
        // Add your user profile logic here
    }

    function handleActionBtnClick() {
        console.log('Action button clicked');
        // Add your upgrade plan logic here
    }

    // Utility Functions
    function handleResize() {
        const wasMobile = isMobile;
        isMobile = window.innerWidth < 768;

        if (wasMobile !== isMobile) {
            updateSidebarState();
        }
    }

    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Animate elements on page load
    function animateOnLoad() {
        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Animate sidebar entrance
        if (!isMobile) {
            sidebar.style.opacity = '0';
            sidebar.style.transform = 'translateX(-20px)';
            setTimeout(() => {
                sidebar.style.transition = 'all 0.5s ease';
                sidebar.style.opacity = '1';
                sidebar.style.transform = 'translateX(0)';
            }, 200);
        }
    }

    // Smooth scroll for navigation
    function enableSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    // Initialize everything when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            init();
            animateOnLoad();
            enableSmoothScroll();
        });
    } else {
        init();
        animateOnLoad();
        enableSmoothScroll();
    }

})();