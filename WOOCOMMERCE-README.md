# Nova Template WP Solar - WooCommerce Integration

## 🚀 Instalación y Configuración

### 1. Instalación de WooCommerce

1. En tu panel de WordPress, ve a **Plugins > Añadir nuevo**
2. Busca "WooCommerce"
3. Instala y activa el plugin de WooCommerce
4. Sigue el asistente de configuración inicial

### 2. Configuración del Tema

El tema Nova Template WP Solar detectará automáticamente WooCommerce y cargará los estilos personalizados.

### 3. Configuración de Menús

Para agregar elementos de WooCommerce a tu sidebar:

1. Ve a **Apariencia > Menús**
2. Selecciona tu menú "SideBar Desktop"
3. Agrega los siguientes elementos recomendados:
   - **Tienda** (página de productos)
   - **Mi cuenta** (página de cuenta de usuario)
   - **Categorías de productos** (opcional)
   - El **Carrito** se agregará automáticamente con contador

### 4. Estructura de Archivos

```
nova-template-wp-solar/
├── woocommerce/                    # Plantillas personalizadas
│   ├── archive-product.php         # Página de tienda
│   ├── single-product.php          # Producto individual
│   ├── content-product.php         # Card de producto
│   ├── content-single-product.php  # Contenido producto single
│   ├── cart/                       # Plantillas del carrito
│   │   └── cart.php               # Página del carrito
│   └── checkout/                   # Plantillas de checkout
│       └── form-checkout.php      # Formulario de checkout
├── inc/
│   └── woocommerce-functions.php   # Funciones de WooCommerce
├── css/
│   └── woocommerce-nova.css        # Estilos personalizados
└── js/
    └── woocommerce-nova.js         # JavaScript personalizado
```

### 5. Características del Diseño

#### 🎨 Diseño Futurista
- Cards de productos con efecto 3D hover
- Badges personalizados (Sale, New, Featured)
- Animaciones suaves y efectos de partículas
- Diseño glassmorphism con blur effects

#### 📱 Totalmente Responsivo
- Grid adaptativo para productos
- Diseño optimizado para móviles
- Navegación táctil mejorada

#### 🌓 Soporte Dark/Light Mode
- Integrado con el sistema de temas del template
- Variables CSS consistentes
- Transiciones suaves entre temas

### 6. Personalización

#### Cambiar número de productos por fila:
En `inc/woocommerce-functions.php`, modifica:
```php
add_filter('loop_shop_columns', function() {
    return 3; // Cambiar número aquí
});
```

#### Cambiar productos por página:
```php
add_filter('loop_shop_per_page', function() {
    return 12; // Cambiar número aquí
});
```

#### Personalizar colores:
Los colores se basan en las variables CSS del tema en `css/variables.css`

### 7. Hooks Disponibles

El tema agrega los siguientes hooks personalizados:
- `nova_product_badges` - Para mostrar badges personalizados
- Todos los hooks estándar de WooCommerce están disponibles

### 8. Optimización

- Los estilos por defecto de WooCommerce están desactivados
- JavaScript optimizado con lazy loading
- Imágenes con lazy loading nativo
- CSS minificado en producción

### 9. Solución de Problemas

#### Si los estilos no se cargan:
1. Verifica que WooCommerce esté activo
2. Limpia la caché del navegador
3. Regenera los permalinks en **Ajustes > Enlaces permanentes**

#### Si el carrito no se actualiza:
1. Verifica que no haya conflictos con otros plugins
2. Asegúrate de que AJAX esté funcionando correctamente

### 10. Próximas Mejoras

- [ ] Quick view de productos
- [ ] Wishlist integrada
- [ ] Filtros AJAX
- [ ] Infinite scroll
- [ ] Zoom de producto mejorado
- [ ] Variaciones de producto con swatches

## 📞 Soporte

Para soporte adicional o personalización, contacta con Nova Labs.

---

**Versión:** 1.0.0  
**Compatibilidad:** WooCommerce 8.0+  
**Requisitos:** WordPress 6.0+, PHP 7.4+