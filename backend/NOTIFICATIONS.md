# Sistema de Notificaciones y Emails Transaccionales - Cielo

## Descripción General

El sistema de notificaciones de Cielo permite enviar emails automáticos a clientes y administradores basados en eventos del sistema como creación de pedidos, cambios de estado y confirmaciones de pago.

## Características Principales

- ✅ Emails automáticos basados en eventos
- ✅ Sistema de colas para procesamiento asíncrono
- ✅ Templates responsive con branding de Cielo
- ✅ Panel administrativo para gestión
- ✅ Configuración flexible
- ✅ Sistema de reintentos
- ✅ Logging completo

## Tipos de Notificaciones

### Para Clientes
1. **Confirmación de Pedido** - Se envía cuando se crea un nuevo pedido
2. **Actualización de Estado** - Se envía cuando cambia el estado del pedido
3. **Confirmación de Pago** - Se envía cuando se confirma un pago

### Para Administradores
1. **Nuevo Pedido** - Notifica a los admins sobre nuevos pedidos
2. **Pago Confirmado** - Notifica cuando se confirma un pago
3. **Cambio de Estado** - Opcional, notifica cambios de estado

## Configuración

### Variables de Entorno (.env)
```env
# Email Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@cielo.com
MAIL_FROM_NAME="Cielo"

# Queue Configuration
QUEUE_CONNECTION=database

# Notification Settings
CUSTOMER_EMAIL_ORDER_CONFIRMATION=true
CUSTOMER_EMAIL_ORDER_STATUS=true
CUSTOMER_EMAIL_PAYMENT_CONFIRMATION=true
ADMIN_EMAIL_NEW_ORDER=true
ADMIN_EMAIL_PAYMENT_CONFIRMED=true
ADMIN_EMAIL_ORDER_STATUS=false

# Company Information
NOTIFICATION_COMPANY_NAME="Cielo"
NOTIFICATION_SUPPORT_EMAIL="soporte@cielo.com"
NOTIFICATION_BRAND_COLOR="#2563eb"
```

### Configuración Avanzada
El archivo `config/notifications.php` contiene configuraciones detalladas:
- Habilitación/deshabilitación por tipo
- Configuración de colas
- Configuración de reintentos
- Rate limiting
- Templates y branding

## Uso Básico

### Envío Manual
```php
use App\Services\NotificationService;

$notificationService = app(NotificationService::class);

// Enviar confirmación de pedido
$notificationService->sendOrderConfirmation($order);

// Enviar actualización de estado
$notificationService->sendOrderStatusUpdate($order, $previousStatus);

// Enviar confirmación de pago
$notificationService->sendPaymentConfirmation($payment);
```

### Envío Automático
Los emails se envían automáticamente cuando:
- Se crea un pedido → `OrderCreated` event → `SendOrderNotifications` listener
- Cambia el estado de un pedido → `OrderStatusChanged` event → `SendOrderStatusNotification` listener  
- Se confirma un pago → `PaymentConfirmed` event → `SendPaymentNotification` listener

## Panel Administrativo

Accede a `/admin/notifications` para:
- Ver dashboard de notificaciones
- Enviar emails de prueba
- Gestionar configuración
- Ver estadísticas de envío
- Gestionar cola de emails

## Comandos de Artisan

### Probar Notificaciones
```bash
# Ver opciones disponibles
php artisan notifications:test

# Probar confirmación de pedido
php artisan notifications:test order-confirmation --user-id=1 --order-id=1

# Probar todas las notificaciones
php artisan notifications:test all
```

### Gestionar Colas
```bash
# Procesar cola de emails
php artisan queue:work --queue=emails

# Ver trabajos en cola
php artisan queue:monitor

# Limpiar trabajos fallidos
php artisan queue:flush
```

## Templates de Email

Los templates están ubicados en `resources/views/emails/`:

### Estructura
```
emails/
├── orders/
│   ├── confirmation.blade.php     # Confirmación de pedido
│   └── status-update.blade.php    # Actualización de estado
├── payments/
│   └── confirmation.blade.php     # Confirmación de pago
└── admin/
    └── new-order.blade.php        # Nuevo pedido (admin)
```

### Personalización
Los templates usan Markdown de Laravel y son completamente personalizables:
- Colores del brand
- Logo de la empresa
- Información de contacto
- Estructura del contenido

## Eventos y Listeners

### Eventos Disponibles
- `App\Events\OrderCreated` - Cuando se crea un pedido
- `App\Events\OrderStatusChanged` - Cuando cambia el estado
- `App\Events\PaymentConfirmed` - Cuando se confirma un pago

### Listeners
- `App\Listeners\SendOrderNotifications` - Maneja nuevos pedidos
- `App\Listeners\SendOrderStatusNotification` - Maneja cambios de estado
- `App\Listeners\SendPaymentNotification` - Maneja confirmaciones de pago

## Sistema de Colas

### Configuración
- Por defecto usa driver `database`
- Cola específica: `emails`
- Reintentos automáticos configurables
- Logging de fallos

### Monitoreo
```bash
# Verificar estado de la cola
php artisan queue:monitor

# Ver trabajos fallidos
php artisan queue:failed

# Reintentar trabajos fallidos
php artisan queue:retry all
```

## Logging

Todos los eventos de notificaciones se registran en:
- `storage/logs/laravel.log`
- Incluye información de éxito/error
- IDs de pedido, usuario y email
- Detalles de errores para debugging

## Solución de Problemas

### Emails no se envían
1. Verificar configuración SMTP en `.env`
2. Comprobar que la cola esté procesándose: `php artisan queue:work`
3. Revisar logs en `storage/logs/laravel.log`
4. Verificar que las notificaciones estén habilitadas en configuración

### Errores comunes
- **Authentication failed**: Verificar credenciales SMTP
- **Connection timeout**: Verificar host y puerto SMTP
- **Queue not processing**: Iniciar worker con `php artisan queue:work`

### Testing
```bash
# Probar configuración de email
php artisan notifications:test order-confirmation --user-id=1

# Probar en modo desarrollo (logs only)
MAIL_MAILER=log php artisan notifications:test all
```

## Extensión del Sistema

### Agregar nuevo tipo de notificación
1. Crear Mailable: `php artisan make:mail NewNotification`
2. Crear Event: `php artisan make:event NewEvent`
3. Crear Listener: `php artisan make:listener NewListener`
4. Registrar en `EventServiceProvider`
5. Agregar template en `resources/views/emails/`
6. Actualizar `NotificationService`

### Personalizar templates
1. Editar archivos en `resources/views/emails/`
2. Usar variables disponibles del modelo
3. Mantener estructura responsive
4. Probar en diferentes clientes de email

## Mejores Prácticas

1. **Siempre usar colas** para emails en producción
2. **Monitorear logs** regularmente
3. **Probar cambios** en staging antes de producción
4. **Configurar rate limiting** para evitar spam
5. **Usar templates consistentes** con el branding
6. **Incluir enlaces de cancelación** de suscripción (próximamente)
7. **Optimizar para móviles** todos los templates

## Próximas Mejoras

- [ ] SMS notifications
- [ ] Push notifications
- [ ] Email preferences por usuario
- [ ] Analytics de apertura/clicks
- [ ] Templates drag-and-drop
- [ ] Notificaciones en tiempo real (WebSocket)
- [ ] Integración con servicios externos (SendGrid, Mailgun)