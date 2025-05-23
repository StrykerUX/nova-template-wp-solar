#!/bin/bash
# Setup script for Nova Solar Theme

echo "Setting up Nova Solar WordPress Theme..."

# Install dependencies
echo "Installing dependencies..."
npm install

# Compile SCSS
echo "Compiling SCSS to CSS..."
npm run build:expanded

# Create main.css if it doesn't exist
if [ ! -f "assets/css/main.css" ]; then
    mkdir -p assets/css
    echo "/* Nova Solar Theme - Main CSS */" > assets/css/main.css
    echo "/* Run 'npm run build' to compile from SCSS */" >> assets/css/main.css
fi

echo "Setup complete!"
echo ""
echo "Next steps:"
echo "1. Create screenshot.png (see SCREENSHOT_INSTRUCTIONS.md)"
echo "2. Upload the theme to WordPress"
echo "3. Activate the theme"
echo ""
echo "For development:"
echo "- Run 'npm run watch' to watch for SCSS changes"
echo "- Run 'npm run build:production' for production build"
