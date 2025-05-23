# Instrucciones de Instalación - Nova Template WP Solar

## Requisitos Previos

- WordPress 5.0 o superior
- PHP 7.0 o superior
- Servidor web con mod_rewrite habilitado

## Pasos de Instalación

### 1. Preparación de Archivos

Antes de instalar, asegúrate de:

1. **Copiar todos los archivos CSS del proyecto original**:
   - Copia toda la carpeta `css` de `C:\Users\abrah\Documents\ai-solar-nova-ui\css` 
   - A `D:\GitHub\nova-template-wp-solar\css`
   - Esto incluye la carpeta `mobile` con todos sus archivos

2. **Copiar archivos JavaScript**:
   - Ya están copiados `main.js` y `mobile.js`

3. **Copiar imágenes** (si las necesitas):
   - Copia cualquier imagen necesaria de `C:\Users\abrah\Documents\ai-solar-nova-ui\img`
   - A `D:\GitHub\nova-template-wp-solar\img`

4. **Crear screenshot.png**:
   - Crea una captura de pantalla de 1200x900 píxeles
   - Guárdala como `screenshot.png` en la raíz del tema

### 2. Instalación en WordPress

#### Opción A: Mediante ZIP
1. Comprime la carpeta `nova-template-wp-solar` en un archivo ZIP
2. En WordPress, ve a **Apariencia > Temas > Añadir nuevo**
3. Haz clic en **Subir tema**
4. Selecciona el archivo ZIP y haz clic en **Instalar ahora**
5. Activa el tema

#### Opción B: Mediante FTP
1. Sube la carpeta `nova-template-wp-solar` a `/wp-content/themes/`
2. En WordPress, ve a **Apariencia > Temas**
3. Encuentra "Nova Template WP Solar" y actívalo

### 3. Configuración Inicial

#### Logos
1. Ve a **Apariencia > Personalizar > Logo Settings**
2. Sube tu logo icono (40x40px recomendado)
3. Sube tu logo completo (150px ancho recomendado)

#### Menú Principal
1. Ve a **Apariencia > Menús**
2. Crea un nuevo menú llamado "Menú Principal"
3. Añade las páginas/enlaces que desees
4. En **Ubicaciones del menú**, marca **SideBar Desktop**
5. Guarda el menú

#### Añadir Iconos al Menú
1. En cada elemento del menú, encontrarás un campo "Icon HTML"
2. Añade el código HTML del icono deseado:
   ```html
   <i class="ti ti-home"></i>
   <i class="ti ti-dashboard"></i>
   <i class="ti ti-file-text"></i>
   <i class="ti ti-settings"></i>
   ```
3. Encuentra más iconos en: https://tabler-icons.io/

#### Añadir Separadores al Menú
1. Crea un **Enlace personalizado**
2. URL: `#`
3. Texto del enlace: `--separator--`
4. Añádelo donde quieras el separador

#### Menú Móvil (Opcional)
1. Crea otro menú para móvil
2. Asígnalo a **Mobile Bottom Navigation**
3. Solo añade 3-4 elementos principales

### 4. Configurar Plantillas de Página

Al crear páginas, selecciona la plantilla apropiada:

- **Dashboard Over**: Para páginas normales con el dashboard
- **Dashboard Canvas**: Para aplicaciones de pantalla completa
- **Por defecto**: Para páginas sin dashboard (landing pages, etc.)

### 5. Personalización Adicional

#### Tema por Defecto
1. Ve a **Apariencia > Personalizar > Theme Options**
2. Selecciona el tema por defecto (Dark/Light)
3. Selecciona el estado inicial del sidebar

#### Usuario
- El tema automáticamente mostrará el avatar del usuario logueado
- Si no hay avatar, mostrará un placeholder con la inicial

### Solución de Problemas

#### El sidebar no se ve correctamente
- Verifica que todos los archivos CSS estén copiados correctamente
- Limpia la caché del navegador
- Verifica la consola por errores de JavaScript

#### Los iconos no se muestran
- Asegúrate de que Tabler Icons se está cargando correctamente
- Verifica que el HTML del icono sea correcto
- Prueba con: `<i class="ti ti-home"></i>`

#### El tema claro/oscuro no funciona
- Verifica que JavaScript esté habilitado
- Limpia localStorage del navegador
- Verifica la consola por errores

## Notas Importantes

1. **No modifiques** los archivos CSS principales directamente
2. Para personalizaciones, usa el **CSS adicional** en el personalizador
3. El tema guarda preferencias en localStorage (tema, estado del sidebar)
4. Los archivos JavaScript deben mantener su estructura original

## Soporte

Para soporte adicional:
- Email: soporte@novalabss.com
- Web: https://novalabss.com
- Documentación: Ver README.md