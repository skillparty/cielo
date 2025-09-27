# Sistema de Diseño - Cielo Carnes

## 1. Paleta de Colores

### Colores Primarios
- **Rojo Carne** (#8B2635): Color principal que representa la carne fresca y la pasión por la calidad
- **Rojo Oscuro** (#5D1921): Para acentos y hover states
- **Rojo Claro** (#A73E4C): Para fondos suaves y estados activos

### Colores Secundarios
- **Dorado** (#D4A574): Representa calidad premium y tradición
- **Marrón** (#6F4E37): Para elementos de apoyo y textos secundarios
- **Naranja Suave** (#E8B87F): Para destacados y promociones

### Colores Neutros
- **Gris Oscuro** (#2C3E50): Textos principales
- **Gris Medio** (#7F8C8D): Textos secundarios
- **Gris Claro** (#ECF0F1): Fondos y bordes
- **Blanco** (#FFFFFF): Fondos principales
- **Crema** (#FFF8F3): Fondos alternativos cálidos

### Colores de Estado
- **Éxito** (#27AE60): Confirmaciones y estados positivos
- **Advertencia** (#F39C12): Alertas y avisos
- **Error** (#E74C3C): Errores y validaciones
- **Información** (#3498DB): Mensajes informativos

## 2. Tipografía

### Fuentes
- **Headings**: 'Playfair Display' - Serif elegante para títulos
- **Body**: 'Inter' - Sans-serif moderna y legible
- **Monospace**: 'JetBrains Mono' - Para precios y códigos

### Tamaños
- **h1**: 3.5rem (56px) - Hero sections
- **h2**: 2.5rem (40px) - Títulos de sección
- **h3**: 2rem (32px) - Subtítulos
- **h4**: 1.5rem (24px) - Cards y componentes
- **h5**: 1.25rem (20px) - Elementos menores
- **h6**: 1rem (16px) - Etiquetas
- **body**: 1rem (16px) - Texto normal
- **small**: 0.875rem (14px) - Texto pequeño

## 3. Espaciado

### Sistema de 8 puntos
- **xs**: 0.5rem (8px)
- **sm**: 1rem (16px)
- **md**: 1.5rem (24px)
- **lg**: 2rem (32px)
- **xl**: 3rem (48px)
- **2xl**: 4rem (64px)
- **3xl**: 6rem (96px)

## 4. Bordes y Sombras

### Border Radius
- **none**: 0
- **sm**: 0.25rem (4px)
- **default**: 0.5rem (8px)
- **md**: 0.75rem (12px)
- **lg**: 1rem (16px)
- **xl**: 1.5rem (24px)
- **full**: 9999px

### Sombras
- **sm**: 0 1px 2px rgba(0,0,0,0.05)
- **default**: 0 4px 6px rgba(0,0,0,0.1)
- **md**: 0 10px 15px rgba(0,0,0,0.1)
- **lg**: 0 20px 25px rgba(0,0,0,0.1)
- **xl**: 0 25px 50px rgba(0,0,0,0.25)

## 5. Breakpoints

- **mobile**: 320px - 639px
- **tablet**: 640px - 1023px
- **desktop**: 1024px - 1279px
- **wide**: 1280px+

## 6. Componentes Base

### Botones
- **Primary**: Fondo rojo carne, texto blanco
- **Secondary**: Fondo dorado, texto oscuro
- **Outline**: Borde rojo, fondo transparente
- **Ghost**: Sin borde, hover con fondo suave
- **Danger**: Fondo rojo error, texto blanco

### Cards
- Fondo blanco o crema
- Sombra suave
- Border radius default
- Padding consistente

### Formularios
- Inputs con borde gris claro
- Focus con borde rojo carne
- Labels en gris oscuro
- Mensajes de error en rojo

## 7. Iconografía

- Usar iconos de Lucide React
- Tamaño base: 24px
- Colores consistentes con la paleta
- Stroke width: 2px

## 8. Animaciones

- **Duración estándar**: 200ms
- **Easing**: cubic-bezier(0.4, 0, 0.2, 1)
- **Hover effects**: Transiciones suaves
- **Loading states**: Skeleton screens

## 9. Principios de Diseño

1. **Claridad**: Información clara y jerarquizada
2. **Consistencia**: Elementos uniformes en toda la aplicación
3. **Accesibilidad**: Contraste adecuado y navegación por teclado
4. **Responsividad**: Mobile-first approach
5. **Performance**: Optimización de imágenes y lazy loading
