@echo off
REM Setup script for Nova Solar Theme

echo Setting up Nova Solar WordPress Theme...

REM Install dependencies
echo Installing dependencies...
call npm install

REM Compile SCSS
echo Compiling SCSS to CSS...
call npm run build:expanded

REM Create main.css if it doesn't exist
if not exist "assets\css\main.css" (
    mkdir assets\css 2>nul
    echo /* Nova Solar Theme - Main CSS */ > assets\css\main.css
    echo /* Run 'npm run build' to compile from SCSS */ >> assets\css\main.css
)

echo.
echo Setup complete!
echo.
echo Next steps:
echo 1. Create screenshot.png (see SCREENSHOT_INSTRUCTIONS.md)
echo 2. Upload the theme to WordPress
echo 3. Activate the theme
echo.
echo For development:
echo - Run 'npm run watch' to watch for SCSS changes
echo - Run 'npm run build:production' for production build
echo.
pause
