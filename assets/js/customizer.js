/**
 * Nova Solar Theme - Customizer Live Preview
 */

(function($) {
    'use strict';

    // Primary color
    wp.customize('nova_solar_primary_color', function(value) {
        value.bind(function(to) {
            $('style#nova-solar-primary-color').remove();
            $('head').append('<style id="nova-solar-primary-color">:root { --nova-primary: ' + to + '; }</style>');
        });
    });

    // Secondary color
    wp.customize('nova_solar_secondary_color', function(value) {
        value.bind(function(to) {
            $('style#nova-solar-secondary-color').remove();
            $('head').append('<style id="nova-solar-secondary-color">:root { --nova-secondary: ' + to + '; }</style>');
        });
    });

    // Sidebar width
    wp.customize('nova_solar_sidebar_width', function(value) {
        value.bind(function(to) {
            $('style#nova-solar-sidebar-width').remove();
            $('head').append('<style id="nova-solar-sidebar-width">:root { --nova-sidebar-width: ' + to + 'px; }</style>');
        });
    });

    // Dot pattern opacity
    wp.customize('nova_solar_dot_opacity', function(value) {
        value.bind(function(to) {
            $('.dashboard-wrapper::before').css('opacity', to);
        });
    });

    // Base font size
    wp.customize('nova_solar_base_font_size', function(value) {
        value.bind(function(to) {
            $('html').css('font-size', to + 'px');
        });
    });

    // Live preview of theme modifications
    wp.customize('nova_solar_default_theme', function(value) {
        value.bind(function(to) {
            // This would normally require a page refresh, but we can show a preview
            $('body').removeClass('theme-dark theme-light').addClass('theme-' + to);
        });
    });

})(jQuery);
