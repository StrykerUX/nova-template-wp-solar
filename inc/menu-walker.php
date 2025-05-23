<?php
/**
 * Custom Navigation Menu Walker Classes
 *
 * @package Nova_Template_WP_Solar
 */

/**
 * Custom Walker for Sidebar Desktop Menu
 */
class Nova_Sidebar_Walker extends Walker_Nav_Menu {
    
    /**
     * Starts the list before the elements are added.
     */
    public function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"nav-sub-list\">\n";
    }
    
    /**
     * Ends the list after the elements are added.
     */
    public function end_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
    
    /**
     * Starts the element output.
     */
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        // Check if this is a separator
        if ($item->title === '--separator--') {
            $output .= $indent . '<li class="nav-separator"></li>' . "\n";
            return;
        }
        
        // Check if current page
        if (in_array('current-menu-item', $classes) || in_array('current-menu-parent', $classes)) {
            $classes[] = 'active';
        }
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        $output .= $indent . '<li' . $id . $class_names . '>';
        
        $attributes  = !empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target)     ? ' target="' . esc_attr($item->target     ) . '"' : '';
        $attributes .= !empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn        ) . '"' : '';
        $attributes .= !empty($item->url)        ? ' href="'   . esc_attr($item->url        ) . '"' : '';
        $attributes .= ' class="nav-item"';
        
        // Get custom icon
        $icon_html = get_post_meta($item->ID, '_menu_item_icon', true);
        
        // Default icon if none set
        if (empty($icon_html)) {
            $icon_html = '<i class="ti ti-link"></i>';
        }
        
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= '<div class="nav-item-icon">';
        $item_output .= $icon_html;
        $item_output .= '</div>';
        $item_output .= '<span class="nav-item-text">';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</span>';
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    
    /**
     * Ends the element output.
     */
    public function end_el(&$output, $item, $depth = 0, $args = null) {
        if ($item->title !== '--separator--') {
            $output .= "</li>\n";
        }
    }
}

/**
 * Custom Walker for Mobile Bottom Navigation
 */
class Nova_Mobile_Bottom_Walker extends Walker_Nav_Menu {
    
    /**
     * We only want the top level items, no sub-menus
     */
    public function start_lvl(&$output, $depth = 0, $args = null) {
        // Don't output sub-levels
    }
    
    public function end_lvl(&$output, $depth = 0, $args = null) {
        // Don't output sub-levels
    }
    
    /**
     * Start the element output.
     */
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        // Only output top-level items
        if ($depth !== 0) {
            return;
        }
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'bottom-nav-item';
        
        // Check if current page
        if (in_array('current-menu-item', $classes) || in_array('current-menu-parent', $classes)) {
            $classes[] = 'active';
        }
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $attributes  = !empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target)     ? ' target="' . esc_attr($item->target     ) . '"' : '';
        $attributes .= !empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn        ) . '"' : '';
        $attributes .= !empty($item->url)        ? ' href="'   . esc_attr($item->url        ) . '"' : '';
        
        // Get custom icon
        $icon_html = get_post_meta($item->ID, '_menu_item_icon', true);
        
        // Default icon if none set
        if (empty($icon_html)) {
            $icon_html = '<i class="ti ti-link"></i>';
        }
        
        $item_output = '<button' . $class_names . ' onclick="window.location.href=\'' . esc_attr($item->url) . '\'">';
        $item_output .= '<div class="bottom-nav-icon">';
        $item_output .= $icon_html;
        $item_output .= '</div>';
        $item_output .= '</button>';
        
        $output .= $item_output;
    }
    
    /**
     * Ends the element output.
     */
    public function end_el(&$output, $item, $depth = 0, $args = null) {
        // No closing tag needed for buttons
    }
}

/**
 * Fallback for mobile bottom navigation
 */
function nova_mobile_bottom_fallback() {
    ?>
    <button class="bottom-nav-item active">
        <div class="bottom-nav-icon">
            <i class="ti ti-layout-grid"></i>
        </div>
    </button>
    <button class="bottom-nav-item" onclick="window.location.href='<?php echo esc_url(home_url('/')); ?>'">
        <div class="bottom-nav-icon">
            <i class="ti ti-home"></i>
        </div>
    </button>
    <button class="bottom-nav-item" onclick="window.location.href='<?php echo esc_url(admin_url()); ?>'">
        <div class="bottom-nav-icon">
            <i class="ti ti-dashboard"></i>
        </div>
    </button>
    <?php
}