# Nova Template WP Solar

Un tema de WordPress moderno con un dashboard elegante, sidebar dinámico y soporte completo para personalización.

## Características

- **Dashboard Moderno**: Interfaz moderna con sidebar flotante y diseño responsivo
- **Tema Oscuro/Claro**: Cambio dinámico entre temas con persistencia en localStorage
- **Sidebar Dinámico**: Sidebar que se puede expandir/contraer con animaciones suaves
- **Logos Personalizables**: Soporte para logo icono y logo completo desde el personalizador
- **Menús de WordPress**: Integración completa con el sistema de menús de WordPress
- **Soporte para Iconos**: Capacidad de añadir iconos HTML personalizados a los elementos del menú
- **3 Plantillas de Página**:
  - **Por defecto**: Sin dashboard, solo contenido con footer simple
  - **Dashboard Canvas**: Sin scroll, contenido ocupa 100% del área disponible
  - **Dashboard Over**: Con scroll normal y padding estándar
- **Totalmente Responsivo**: Diseño optimizado para móviles con navegación inferior
- **Soporte para Usuario**: Muestra avatar del usuario o placeholder con inicial

## Instalación

1. Descarga el tema
2. Sube la carpeta `nova-template-wp-solar` a `/wp-content/themes/`
3. Activa el tema desde el panel de WordPress

## Configuración

### Logos

1. Ve a **Apariencia > Personalizar > Logo Settings**
2. Sube tu **Logo Icon** (se muestra siempre, recomendado 40x40px)
3. Sube tu **Full Logo** (se muestra cuando el sidebar está expandido, recomendado 150px de ancho)

### Menús

1. Ve a **Apariencia > Menús**
2. Crea un menú y asígnalo a **"SideBar Desktop"**
3. Para añadir iconos a los elementos del menú:
   - En cada elemento del menú, encontrarás un campo "Icon HTML"
   - Añade el HTML del icono, por ejemplo: `<i class="ti ti-home"></i>`
4. Para añadir separadores:
   - Crea un enlace personalizado con URL `#` y título `--separator--`

### Menú Móvil

1. Crea un menú separado para móvil
2. Asígnalo a **"Mobile Bottom Navigation"**
3. Solo se mostrarán los elementos de primer nivel

### Plantillas de Página

Al crear o editar una página, en **Atributos de página** puedes seleccionar:

- **Por defecto**: Página simple sin dashboard
- **Dashboard Canvas**: Para contenido que necesita ocupar toda la pantalla (ej: mapas, aplicaciones)
- **Dashboard Over**: Para páginas normales con el dashboard

## Personalización

### Tema por Defecto

Ve a **Apariencia > Personalizar > Theme Options** para configurar:
- Tema por defecto (Dark/Light)
- Estado inicial del sidebar (Abierto/Cerrado)

### CSS Personalizado

El tema usa variables CSS que puedes sobrescribir:

```css
:root {
  --bg-primary: #1a1a1a;
  --text-primary: #ffffff;
  --accent-primary: #ffffff;
  /* ... más variables en css/variables.css */
}
```

### Funciones Auxiliares

- `nova_template_get_user_avatar($user_id)` - Obtiene el avatar del usuario con fallback
- `nova_template_logo_icon()` - Muestra el logo icono
- `nova_template_logo_full()` - Muestra el logo completo

## Estructura de Archivos

```
nova-template-wp-solar/
├── css/
│   ├── main.css           # Archivo principal de estilos
│   ├── variables.css      # Variables CSS
│   ├── base.css           # Estilos base
│   ├── sidebar.css        # Estilos del sidebar
│   ├── buttons.css        # Estilos de botones
│   ├── components.css     # Componentes reutilizables
│   ├── bottom-navigation.css # Navegación móvil
│   └── mobile/            # Estilos específicos para móvil
├── js/
│   ├── main.js            # JavaScript principal
│   ├── mobile.js          # JavaScript para móvil
│   └── customizer.js      # Scripts del personalizador
├── inc/
│   ├── customizer.php     # Configuración del personalizador
│   ├── menu-walker.php    # Clases Walker para menús
│   ├── template-functions.php # Funciones del tema
│   └── logo-functions.php # Funciones para logos
├── page-templates/        # Plantillas de página
├── img/                   # Imágenes del tema
└── [archivos principales de WordPress]
```

## Soporte para Iconos

El tema usa Tabler Icons. Puedes encontrar todos los iconos disponibles en:
https://tabler-icons.io/

Ejemplo de uso:
```html
<i class="ti ti-home"></i>
```

## Hooks y Filtros

### Filtros Disponibles

- `nova_template_custom_background_args` - Argumentos del fondo personalizado
- `nova_template_content_wrapper_classes` - Clases del wrapper de contenido
- `nova_template_main_content_classes` - Clases del contenido principal

### Actions Disponibles

- `nova_template_before_sidebar` - Antes del sidebar
- `nova_template_after_sidebar` - Después del sidebar

## Requisitos

- WordPress 5.0 o superior
- PHP 7.0 o superior

## Licencia

Este tema está licenciado bajo GPL v2 o posterior.

## Créditos

- Desarrollado por NovaLabss
- Iconos por Tabler Icons
- Basado en el proyecto ai-solar-nova-ui

## Soporte

Para soporte y consultas, visita: https://novalabss.com