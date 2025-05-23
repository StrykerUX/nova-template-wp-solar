# Nova Solar WordPress Theme

A professional WordPress theme with Canvas and Dashboard templates, featuring dark/light modes and a modular CSS architecture designed for extensibility.

## Features

- **3 Template Types:**
  - **Canvas QL (Default)**: No header, simple footer with "Powered By NovaLabss"
  - **Canvas Full**: Completely blank canvas for full customization
  - **Dashboard**: Two versions (Overflow/Full) with sidebar navigation and advanced UI
  
- **Dark/Light Theme Modes**: Persistent theme switching across pages
- **Modular SCSS Architecture**: Organized and maintainable stylesheet structure
- **CSS Custom Properties**: Extensible variables for plugin integration
- **Responsive Design**: Mobile-first approach with dedicated mobile navigation
- **Fisheye Dot Pattern**: Unique background effect for dashboard templates
- **Tabler Icons**: Comprehensive icon library included

## Installation

1. Download the theme files
2. Upload to `/wp-content/themes/nova-template-wp-solar/`
3. Activate the theme through the WordPress admin panel

## Development Setup

### Requirements

- Node.js and npm
- Sass compiler
- WordPress 5.0 or higher
- PHP 7.0 or higher

### Compiling SCSS

Install dependencies:
```bash
npm install
```

Watch for changes:
```bash
npm run watch
```

Build for production:
```bash
npm run build
```

## Template Usage

### Canvas QL Template
Perfect for landing pages with minimal chrome:
```php
/*
Template Name: Canvas QL
*/
```

### Canvas Full Template
Complete blank slate for custom applications:
```php
/*
Template Name: Canvas Full
*/
```

### Dashboard Templates
For admin panels and applications:
```php
/*
Template Name: Dashboard Overflow
*/
// or
/*
Template Name: Dashboard Full
*/
```

## CSS Variables

The theme uses CSS custom properties that can be accessed by plugins:

```css
/* Colors */
--nova-primary: #007bff;
--nova-secondary: #6c757d;
--nova-success: #28a745;
--nova-danger: #dc3545;
--nova-warning: #ffc107;
--nova-info: #17a2b8;

/* Theme Colors (changes with dark/light mode) */
--nova-bg-primary: #0a0a0a;
--nova-bg-secondary: #1a1a1a;
--nova-bg-tertiary: #2a2a2a;
--nova-text-primary: #ffffff;
--nova-text-secondary: #b0b0b0;

/* Spacing */
--nova-spacing-xs: 0.25rem;
--nova-spacing-sm: 0.5rem;
--nova-spacing-md: 1rem;
--nova-spacing-lg: 1.5rem;
--nova-spacing-xl: 2rem;
--nova-spacing-xxl: 3rem;

/* And many more... */
```

## Plugin Integration

The theme is designed to work seamlessly with plugins by:
1. Providing consistent CSS variables
2. Offering hooks and filters for customization
3. Supporting style overrides through theme settings

### Available Hooks

```php
// Modify dashboard menu items
add_filter('nova_solar_dashboard_menu', 'your_function');

// Modify warp status data
add_filter('nova_solar_warp_status', 'your_function');

// Override plugin styles
add_filter('nova_solar_override_plugin_styles', '__return_true');
```

## Theme Customizer

Access theme options through **Appearance > Customize > Nova Solar Options**:

- **Colors**: Primary and secondary color customization
- **Dashboard Settings**: Sidebar width, theme mode, pattern opacity
- **Typography**: Base font size adjustment

## JavaScript API

### Theme Mode
```javascript
// Change theme mode
NovaSolar.setThemeMode('light'); // or 'dark'

// Get current theme mode
const mode = NovaSolar.getCookie('nova_theme_mode');
```

### Sidebar Control
```javascript
// Toggle sidebar
NovaSolar.toggleSidebar();

// Check sidebar state
const isCollapsed = $('.dashboard-sidebar').hasClass('is-collapsed');
```

## File Structure

```
nova-template-wp-solar/
├── assets/
│   ├── css/           # Compiled CSS
│   ├── scss/          # Source SCSS files
│   │   ├── abstracts/ # Variables, mixins, functions
│   │   ├── base/      # Reset, typography, base styles
│   │   ├── components/# Buttons, cards, forms, etc.
│   │   ├── layout/    # Header, footer, sidebar, grid
│   │   └── templates/ # Template-specific styles
│   ├── js/            # JavaScript files
│   └── images/        # Theme images
├── includes/          # PHP includes
├── templates/         # Page templates
├── functions.php      # Theme functions
├── style.css         # Theme info
└── README.md         # Documentation
```

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a new Pull Request

## License

GPL v2 or later

## Credits

- **Author**: NovaLabss
- **Icons**: Tabler Icons
- **Framework**: Custom SCSS architecture

## Support

For support, please visit [https://novalabss.com/](https://novalabss.com/)
