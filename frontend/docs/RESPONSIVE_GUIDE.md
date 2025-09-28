# Guía de Responsive Design - Cielo Carnes

## 📱 Breakpoints Implementados

### Breakpoints Principales
- **xs**: < 375px (Teléfonos muy pequeños)
- **sm**: 375px - 639px (Teléfonos)
- **md**: 640px - 767px (Teléfonos grandes/Tablets pequeñas)
- **lg**: 768px - 1023px (Tablets)
- **xl**: 1024px - 1279px (Laptops)
- **2xl**: >= 1280px (Desktops)

### Breakpoints Adicionales
- **Landscape móvil**: `@media (orientation: landscape) and (max-height: 500px)`
- **Touch devices**: `@media (hover: none) and (pointer: coarse)`
- **High DPI**: `@media (-webkit-min-device-pixel-ratio: 2)`

## 🎨 Componentes Optimizados

### Header
- **Mobile**: Logo compacto, menú hamburguesa, iconos reducidos
- **Tablet**: Top bar oculta, navegación colapsada
- **Desktop**: Navegación completa con dropdowns

### Hero Section
- **Mobile**: Altura reducida (500px), texto más pequeño
- **Tablet**: Altura media (600px)
- **Desktop**: Altura completa (700px)

### Features Bar
- **Mobile**: Grid 2x2, iconos pequeños, texto reducido
- **Tablet**: Grid 2x2 o 4x1 según espacio
- **Desktop**: Grid 4x1 completo

### Footer
- **Mobile**: Columnas apiladas, texto compacto
- **Tablet**: 2 columnas principales
- **Desktop**: 5 columnas completas

## 🔧 Técnicas Implementadas

### 1. Mobile-First Approach
```css
/* Base styles para mobile */
.component {
  padding: 0.75rem;
  font-size: 0.875rem;
}

/* Mejoras progresivas */
@media (min-width: 640px) {
  .component {
    padding: 1rem;
    font-size: 1rem;
  }
}
```

### 2. Fluid Typography
```css
/* Escalado responsivo de texto */
h1 {
  font-size: clamp(1.75rem, 4vw, 3.75rem);
}
```

### 3. Flexible Grids
```css
/* Grid adaptativo */
.grid-responsive {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 1rem;
}
```

### 4. Touch-Friendly Targets
```css
/* Mínimo 44px para elementos táctiles */
.touch-target {
  min-height: 44px;
  min-width: 44px;
}
```

## 📐 Espaciado Responsivo

### Padding/Margin System
- **xs**: `px-3` (12px)
- **sm**: `px-4` (16px) 
- **md**: `px-6` (24px)
- **lg**: `px-8` (32px)

### Vertical Spacing
- **Mobile**: `py-8 sm:py-12` (32px → 48px)
- **Desktop**: `py-12 sm:py-16` (48px → 64px)

## 🖼️ Imágenes Responsivas

### Aspect Ratios
```css
/* Mantener proporciones */
.aspect-square { aspect-ratio: 1 / 1; }
.aspect-video { aspect-ratio: 16 / 9; }
```

### Lazy Loading
```jsx
<Image
  src="/image.jpg"
  alt="Description"
  fill
  className="object-cover"
  loading="lazy"
/>
```

## ⚡ Performance Optimizations

### 1. Critical CSS
- Estilos críticos inline para above-the-fold
- CSS no crítico cargado de forma asíncrona

### 2. Image Optimization
- WebP con fallback a JPEG
- Responsive images con `srcset`
- Lazy loading para imágenes below-the-fold

### 3. Font Loading
```css
/* Optimización de fuentes */
@font-face {
  font-family: 'Inter';
  font-display: swap;
  src: url('/fonts/inter.woff2') format('woff2');
}
```

## 🧪 Testing Responsive

### Herramientas de Desarrollo
1. **ResponsiveTestHelper**: Componente integrado que muestra:
   - Viewport actual
   - Breakpoint activo
   - Tipo de dispositivo

### Dispositivos de Prueba
- **iPhone SE**: 375x667
- **iPhone 12**: 390x844
- **iPad**: 768x1024
- **iPad Pro**: 1024x1366
- **Desktop**: 1920x1080

### Chrome DevTools
```javascript
// Simular diferentes dispositivos
// F12 → Toggle Device Toolbar → Seleccionar dispositivo
```

## 🎯 Mejores Prácticas

### 1. Contenido Prioritario
- Mostrar información más importante primero en mobile
- Usar progressive disclosure para contenido secundario

### 2. Navegación
- Menú hamburguesa para mobile
- Breadcrumbs para orientación
- Botones de "Volver arriba"

### 3. Formularios
- Labels claros y visibles
- Inputs con tamaño mínimo de 44px
- Validación en tiempo real

### 4. Performance
- Lazy loading para contenido below-the-fold
- Optimización de imágenes
- Minificación de CSS/JS

## 🔍 Debugging Responsive

### CSS Grid Inspector
```css
/* Visualizar grid en desarrollo */
.debug-grid {
  background-image: 
    linear-gradient(rgba(255,0,0,0.1) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,0,0,0.1) 1px, transparent 1px);
  background-size: 20px 20px;
}
```

### Viewport Meta Tag
```html
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
```

## 📊 Métricas de Éxito

### Core Web Vitals
- **LCP**: < 2.5s (Largest Contentful Paint)
- **FID**: < 100ms (First Input Delay)
- **CLS**: < 0.1 (Cumulative Layout Shift)

### Responsive Metrics
- Usabilidad en dispositivos móviles: > 95%
- Tiempo de carga en 3G: < 3s
- Accesibilidad: Score > 90

## 🚀 Próximas Mejoras

### Container Queries
```css
/* Futuro: Container queries */
@container (max-width: 400px) {
  .card {
    flex-direction: column;
  }
}
```

### CSS Subgrid
```css
/* Futuro: CSS Subgrid */
.grid-container {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
}

.grid-item {
  display: grid;
  grid: subgrid / subgrid;
}
```

---

## 📝 Checklist de Responsive

- [ ] Funciona en todos los breakpoints
- [ ] Touch targets mínimo 44px
- [ ] Texto legible sin zoom
- [ ] Navegación accesible en mobile
- [ ] Imágenes optimizadas
- [ ] Performance < 3s en 3G
- [ ] Accesibilidad completa
- [ ] Testing en dispositivos reales
