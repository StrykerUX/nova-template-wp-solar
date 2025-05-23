# Instalación Rápida - Nova Solar WordPress Theme

## Pasos para instalar y activar el tema:

### 1. Preparación inicial

**Windows:**
```bash
setup.bat
```

**Mac/Linux:**
```bash
chmod +x setup.sh
./setup.sh
```

### 2. Crear screenshot.png
Lee las instrucciones en `SCREENSHOT_INSTRUCTIONS.md` para crear la imagen de vista previa del tema.

### 3. Subir a WordPress

#### Opción A: Instalación directa
1. Comprime la carpeta `nova-template-wp-solar` en un archivo ZIP
2. Ve a WordPress Admin → Apariencia → Temas → Añadir nuevo
3. Haz clic en "Subir tema" y selecciona el archivo ZIP
4. Activa el tema

#### Opción B: Instalación manual
1. Copia la carpeta `nova-template-wp-solar` a `/wp-content/themes/`
2. Ve a WordPress Admin → Apariencia → Temas
3. Activa "Nova Template WP Solar"

### 4. Configuración del tema

1. Ve a **Apariencia → Personalizar → Nova Solar Options**
2. Configura colores, tipografía y opciones del dashboard
3. Crea páginas con los templates:
   - Página → Añadir nueva → Atributos de página → Plantilla
   - Selecciona: Canvas QL, Canvas Full, Dashboard Overflow o Dashboard Full

### 5. Desarrollo

Para trabajar con SCSS:
```bash
# Observar cambios
npm run watch

# Compilar para producción
npm run build:production
```

## Estructura de archivos clave:

- `templates/` - Plantillas de página
- `assets/scss/` - Archivos fuente SCSS
- `assets/css/main.css` - CSS compilado
- `functions.php` - Funciones principales del tema
- `includes/` - Archivos PHP adicionales

## Soporte

Para preguntas o problemas, visita: https://novalabss.com/

---
**Versión**: 1.0.0  
**Autor**: NovaLabss
