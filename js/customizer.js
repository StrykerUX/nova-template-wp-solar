/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function($) {
    'use strict';

    // Site title and description
    wp.customize('blogname', function(value) {
        value.bind(function(to) {
            $('.sidebar-logo-text').text(to);
        });
    });

    wp.customize('blogdescription', function(value) {
        value.bind(function(to) {
            $('.site-description').text(to);
        });
    });

    // Logo Icon
    wp.customize('nova_logo_icon', function(value) {
        value.bind(function(to) {
            if (to) {
                $('.sidebar-logo-icon').html('<img src="' + to + '" alt="Logo Icon">');
            } else {
                $('.sidebar-logo-icon').html('<i class="ti ti-brand-react"></i>');
            }
        });
    });

    // Full Logo
    wp.customize('nova_logo_full', function(value) {
        value.bind(function(to) {
            if (to) {
                if ($('.sidebar-logo img.sidebar-logo-text').length) {
                    $('.sidebar-logo img.sidebar-logo-text').attr('src', to);
                } else {
                    $('.sidebar-logo-text').replaceWith('<img src="' + to + '" alt="Logo" class="sidebar-logo-text">');
                }
            } else {
                if ($('.sidebar-logo img.sidebar-logo-text').length) {
                    $('.sidebar-logo img.sidebar-logo-text').replaceWith('<span class="sidebar-logo-text">' + wp.customize('blogname').get() + '</span>');
                }
            }
        });
    });

    // Default Theme
    wp.customize('nova_default_theme', function(value) {
        value.bind(function(to) {
            // This won't update live, but will be applied on next page load
            console.log('Default theme will be:', to);
        });
    });

    // Default Sidebar State
    wp.customize('nova_sidebar_default', function(value) {
        value.bind(function(to) {
            // This won't update live, but will be applied on next page load
            console.log('Default sidebar state will be:', to);
        });
    });

})(jQuery);