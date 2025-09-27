@component('mail::message')
# {{ $this->getStatusTitle($currentStatus) }}

Hola **{{ $customer->name }}**,

Te escribimos para informarte sobre una actualización en tu pedido.

## Estado del Pedido

@component('mail::panel')
**Pedido #{{ $order->order_number }}** ha cambiado de estado:

**Estado anterior:** {{ $this->getStatusLabel($previousStatus) }}  
**Estado actual:** {{ $this->getStatusLabel($currentStatus) }}
@endcomponent

{{ $this->getStatusMessage($currentStatus) }}

## Detalles del Pedido

**Número de Pedido:** {{ $order->order_number }}  
**Total:** Bs. {{ number_format($order->total, 2) }}  
**Método de Pago:** {{ ucfirst($order->payment->method) }}

@if($currentStatus === 'shipped')
## Información de Seguimiento

Tu pedido está en camino. El tiempo estimado de entrega es de 2-4 horas dependiendo de tu ubicación.

**💡 Consejo:** Mantén tu teléfono disponible, nuestro repartidor se comunicará contigo antes de la entrega.
@endif

@component('mail::button', ['url' => route('orders.show', $order)])
Ver Detalles del Pedido
@endcomponent

## ¿Necesitas Ayuda?

Si tienes alguna pregunta, estamos aquí para ayudarte:

- **Teléfono:** +591 70000000
- **Email:** contacto@cielocarnes.com

Saludos,  
**El equipo de Cielo Carnes**
@endcomponent

@php
function getStatusTitle($status) {
    return match($status) {
        'confirmed' => '✅ Pedido Confirmado',
        'preparing' => '👨‍🍳 Preparando tu Pedido',
        'ready' => '📦 Pedido Listo',
        'shipped' => '🚚 Pedido en Camino',
        'delivered' => '🎉 Pedido Entregado',
        'cancelled' => '❌ Pedido Cancelado',
        default => '📋 Actualización de Pedido'
    };
}

function getStatusLabel($status) {
    return match($status) {
        'pending' => 'Pendiente',
        'confirmed' => 'Confirmado',
        'preparing' => 'Preparando',
        'ready' => 'Listo',
        'shipped' => 'Enviado',
        'delivered' => 'Entregado',
        'cancelled' => 'Cancelado',
        default => ucfirst($status)
    };
}

function getStatusMessage($status) {
    return match($status) {
        'confirmed' => 'Hemos confirmado tu pedido y comenzaremos a prepararlo pronto.',
        'preparing' => 'Nuestro equipo está preparando cuidadosamente tu pedido con los mejores productos.',
        'ready' => 'Tu pedido está listo y preparado para la entrega.',
        'shipped' => 'Tu pedido ha salido de nuestras instalaciones y está en camino hacia ti.',
        'delivered' => '¡Tu pedido ha sido entregado exitosamente! Esperamos que disfrutes de nuestros productos.',
        'cancelled' => 'Tu pedido ha sido cancelado. Si tienes alguna pregunta, no dudes en contactarnos.',
        default => 'Tu pedido ha sido actualizado.'
    };
}
@endphp
