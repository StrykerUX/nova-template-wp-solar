/**
 * Nova WooCommerce JavaScript
 * Futuristic interactions and animations
 */

(function($) {
    'use strict';

    // Initialize when DOM is ready
    $(document).ready(function() {
        initProductCards();
        initGalleryEffects();
        initQuantityControls();
        initVariationEffects();
        initCheckoutEffects();
        initCartEffects();
        initParallaxEffects();
    });

    /**
     * Product Cards Interactions
     */
    function initProductCards() {
        // 3D tilt effect on hover
        $('.nova-product-card').each(function() {
            const card = $(this);
            
            card.on('mousemove', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const rotateX = (y - centerY) / centerY * -10;
                const rotateY = (x - centerX) / centerX * 10;
                
                card.css({
                    'transform': `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateZ(10px)`
                });
            });
            
            card.on('mouseleave', function() {
                card.css({
                    'transform': 'perspective(1000px) rotateX(0) rotateY(0) translateZ(0)'
                });
            });
        });

        // Add to cart animation
        $('.nova-product-card .button').on('click', function(e) {
            const button = $(this);
            const card = button.closest('.nova-product-card');
            
            // Create particle effect
            createParticles(button);
            
            // Pulse animation
            button.addClass('pulse-animation');
            setTimeout(() => {
                button.removeClass('pulse-animation');
            }, 600);
        });
    }

    /**
     * Gallery Effects
     */
    function initGalleryEffects() {
        // Smooth zoom on hover
        $('.woocommerce-product-gallery__image').on('mouseenter', function() {
            $(this).find('img').css('transform', 'scale(1.1)');
        }).on('mouseleave', function() {
            $(this).find('img').css('transform', 'scale(1)');
        });

        // Thumbnail hover effect
        $('.flex-control-thumbs li').on('mouseenter', function() {
            $(this).find('img').css({
                'transform': 'scale(1.05)',
                'filter': 'brightness(1.2)'
            });
        }).on('mouseleave', function() {
            $(this).find('img').css({
                'transform': 'scale(1)',
                'filter': 'brightness(1)'
            });
        });
    }

    /**
     * Custom Quantity Controls
     */
    function initQuantityControls() {
        // Wrap quantity inputs
        $('.quantity').each(function() {
            const wrapper = $(this);
            const input = wrapper.find('input[type="number"]');
            
            if (!wrapper.find('.quantity-nav').length) {
                wrapper.append(`
                    <div class="quantity-nav">
                        <button class="quantity-button quantity-up" type="button">
                            <i class="ti ti-plus"></i>
                        </button>
                        <button class="quantity-button quantity-down" type="button">
                            <i class="ti ti-minus"></i>
                        </button>
                    </div>
                `);
            }
        });

        // Quantity buttons
        $(document).on('click', '.quantity-up', function() {
            const input = $(this).closest('.quantity').find('input');
            const max = parseFloat(input.attr('max')) || 9999;
            const value = parseFloat(input.val()) || 0;
            const step = parseFloat(input.attr('step')) || 1;
            
            if (value < max) {
                input.val(value + step).trigger('change');
                animateQuantityChange($(this), 'up');
            }
        });

        $(document).on('click', '.quantity-down', function() {
            const input = $(this).closest('.quantity').find('input');
            const min = parseFloat(input.attr('min')) || 0;
            const value = parseFloat(input.val()) || 0;
            const step = parseFloat(input.attr('step')) || 1;
            
            if (value > min) {
                input.val(value - step).trigger('change');
                animateQuantityChange($(this), 'down');
            }
        });
    }

    /**
     * Variation Selection Effects
     */
    function initVariationEffects() {
        // Custom select styling
        $('.variations select').each(function() {
            const select = $(this);
            
            // Create custom dropdown
            select.wrap('<div class="nova-select-wrapper"></div>');
            select.after('<i class="ti ti-chevron-down nova-select-arrow"></i>');
        });

        // Variation change animation
        $('.variations select').on('change', function() {
            const select = $(this);
            const wrapper = select.closest('.nova-select-wrapper');
            
            wrapper.addClass('nova-select-active');
            setTimeout(() => {
                wrapper.removeClass('nova-select-active');
            }, 300);
        });
    }

    /**
     * Checkout Effects
     */
    function initCheckoutEffects() {
        // Form field animations
        $('.nova-input, .input-text').on('focus', function() {
            $(this).parent().addClass('field-active');
        }).on('blur', function() {
            if (!$(this).val()) {
                $(this).parent().removeClass('field-active');
            }
        });

        // Payment method selection
        $('.wc_payment_method').on('click', function() {
            $('.wc_payment_method').removeClass('payment-selected');
            $(this).addClass('payment-selected');
        });

        // Place order button effect
        $('#place_order').on('mouseenter', function(e) {
            const button = $(this);
            const rect = button[0].getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            button.css('--mouse-x', x + 'px');
            button.css('--mouse-y', y + 'px');
        });
    }

    /**
     * Cart Effects
     */
    function initCartEffects() {
        // Remove item animation
        $('.product-remove a').on('click', function(e) {
            e.preventDefault();
            const row = $(this).closest('tr');
            
            row.css({
                'transform': 'translateX(100px)',
                'opacity': '0'
            });
            
            setTimeout(() => {
                // Continue with default WooCommerce behavior
                window.location.href = $(this).attr('href');
            }, 300);
        });

        // Update cart animation
        $('button[name="update_cart"]').on('click', function() {
            $('.shop_table').addClass('updating');
            
            setTimeout(() => {
                $('.shop_table').removeClass('updating');
            }, 1000);
        });
    }

    /**
     * Parallax Background Effects
     */
    function initParallaxEffects() {
        if ($(window).width() > 768) {
            $(window).on('scroll', function() {
                const scrolled = $(window).scrollTop();
                
                // Parallax for product images
                $('.nova-product-card img').each(function() {
                    const speed = 0.5;
                    const yPos = -(scrolled * speed);
                    $(this).css('transform', `translateY(${yPos}px)`);
                });
            });
        }
    }

    /**
     * Create Particle Effects
     */
    function createParticles(element) {
        const particleCount = 12;
        const container = $('<div class="particle-container"></div>');
        
        element.append(container);
        
        for (let i = 0; i < particleCount; i++) {
            const particle = $('<div class="particle"></div>');
            const angle = (360 / particleCount) * i;
            const distance = 50 + Math.random() * 50;
            
            particle.css({
                '--angle': angle + 'deg',
                '--distance': distance + 'px',
                '--delay': (i * 0.05) + 's'
            });
            
            container.append(particle);
        }
        
        setTimeout(() => {
            container.remove();
        }, 1000);
    }

    /**
     * Animate Quantity Change
     */
    function animateQuantityChange(button, direction) {
        const icon = $('<span class="quantity-change-icon"></span>');
        icon.text(direction === 'up' ? '+1' : '-1');
        
        button.append(icon);
        
        setTimeout(() => {
            icon.remove();
        }, 600);
    }

    /**
     * AJAX Cart Update
     */
    $(document).on('added_to_cart', function(e, fragments, cart_hash, button) {
        // Update cart count with animation
        const cartCount = $('.nova-cart-count');
        cartCount.addClass('bounce');
        
        setTimeout(() => {
            cartCount.removeClass('bounce');
        }, 600);
        
        // Show success message
        showNotification('Product added to cart!', 'success');
    });

    /**
     * Show Notification
     */
    function showNotification(message, type = 'info') {
        const notification = $(`
            <div class="nova-notification nova-notification-${type}">
                <i class="ti ti-${type === 'success' ? 'check' : 'info-circle'}"></i>
                <span>${message}</span>
            </div>
        `);
        
        $('body').append(notification);
        
        setTimeout(() => {
            notification.addClass('show');
        }, 100);
        
        setTimeout(() => {
            notification.removeClass('show');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }

    /**
     * Smooth Scroll to Elements
     */
    $(document).on('click', 'a[href^="#"]', function(e) {
        const target = $(this.getAttribute('href'));
        if (target.length) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top - 100
            }, 800, 'easeInOutCubic');
        }
    });

})(jQuery);

// CSS for dynamic elements
const dynamicStyles = `
<style>
/* Quantity Controls */
.quantity {
    position: relative;
}

.quantity-nav {
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
    display: flex;
    flex-direction: column;
}

.quantity-button {
    flex: 1;
    padding: 0 var(--spacing-sm);
    background: transparent;
    border: none;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all var(--transition-fast);
}

.quantity-button:hover {
    color: var(--text-primary);
    background: rgba(255, 255, 255, 0.05);
}

.quantity-button i {
    font-size: 12px;
}

/* Select Wrapper */
.nova-select-wrapper {
    position: relative;
}

.nova-select-arrow {
    position: absolute;
    right: var(--spacing-md);
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    transition: all var(--transition-fast);
}

.nova-select-active .nova-select-arrow {
    transform: translateY(-50%) rotate(180deg);
}

/* Particles */
.particle-container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    pointer-events: none;
}

.particle {
    position: absolute;
    width: 4px;
    height: 4px;
    background: var(--accent-primary);
    border-radius: 50%;
    animation: particleAnimation 1s ease-out forwards;
    animation-delay: var(--delay);
}

@keyframes particleAnimation {
    0% {
        transform: translate(0, 0) scale(1);
        opacity: 1;
    }
    100% {
        transform: 
            rotate(var(--angle)) 
            translateX(var(--distance)) 
            scale(0);
        opacity: 0;
    }
}

/* Quantity Change Icon */
.quantity-change-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-weight: bold;
    color: var(--accent-primary);
    animation: quantityChange 0.6s ease-out;
    pointer-events: none;
}

@keyframes quantityChange {
    0% {
        transform: translate(-50%, -50%) translateY(0);
        opacity: 1;
    }
    100% {
        transform: translate(-50%, -50%) translateY(-20px);
        opacity: 0;
    }
}

/* Notifications */
.nova-notification {
    position: fixed;
    top: var(--spacing-xl);
    right: var(--spacing-xl);
    padding: var(--spacing-md) var(--spacing-lg);
    background: var(--bg-secondary);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    transform: translateX(400px);
    transition: transform var(--transition-normal);
    z-index: var(--z-tooltip);
    backdrop-filter: blur(10px);
}

.nova-notification.show {
    transform: translateX(0);
}

.nova-notification-success {
    border-color: rgba(87, 255, 196, 0.3);
    background: rgba(87, 255, 196, 0.1);
    color: #57FFC4;
}

/* Pulse Animation */
.pulse-animation {
    animation: pulse 0.6s ease-out;
}

/* Bounce Animation */
.bounce {
    animation: bounce 0.6s ease-out;
}

@keyframes bounce {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.2);
    }
}

/* Payment Selected */
.payment-selected {
    background: rgba(255, 255, 255, 0.05) !important;
    border-color: var(--accent-primary) !important;
}

/* Field Active */
.field-active .nova-label {
    color: var(--accent-primary);
}

/* Updating State */
.updating {
    opacity: 0.6;
    pointer-events: none;
}
</style>
`;

// Append dynamic styles
document.head.insertAdjacentHTML('beforeend', dynamicStyles);