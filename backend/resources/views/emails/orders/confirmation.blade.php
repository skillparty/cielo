@component('mail::message')
# ¡Gracias por tu pedido! 🎉

Hola **{{ $customer->name }}**,

Hemos recibido tu pedido y está siendo procesado. Te mantendremos informado sobre el estado de tu pedido.

## Detalles del Pedido

**Número de Pedido:** {{ $order->order_number }}  
**Fecha:** {{ $order->created_at->format('d/m/Y H:i') }}  
**Estado:** {{ ucfirst($order->status) }}

## Productos Pedidos

@component('mail::table')
| Producto | Cantidad | Precio | Subtotal |
|:---------|:---------|:-------|:---------|
@foreach($items as $item)
| {{ $item->product->name }} | {{ $item->quantity }} | Bs. {{ number_format($item->price, 2) }} | Bs. {{ number_format($item->quantity * $item->price, 2) }} |
@endforeach
@endcomponent

## Resumen del Pedido

**Subtotal:** Bs. {{ number_format($order->subtotal, 2) }}  
**Impuestos:** Bs. {{ number_format($order->tax_amount, 2) }}  
**Envío:** Bs. {{ number_format($order->shipping_cost, 2) }}  
**Total:** Bs. {{ number_format($order->total, 2) }}

## Información de Entrega

**Dirección:**  
{{ $order->shipping_address_line1 }}  
@if($order->shipping_address_line2)
{{ $order->shipping_address_line2 }}  
@endif
{{ $order->shipping_city }}, {{ $order->shipping_state }}

**Método de Pago:** {{ ucfirst($order->payment->method) }}

@component('mail::button', ['url' => route('orders.show', $order)])
Ver Detalles del Pedido
@endcomponent

## ¿Necesitas Ayuda?

Si tienes alguna pregunta sobre tu pedido, no dudes en contactarnos:

- **Teléfono:** +591 70000000
- **Email:** contacto@cielocarnes.com
- **WhatsApp:** +591 70000000

¡Gracias por elegir Cielo Carnes! 🥩

Saludos,  
**El equipo de Cielo Carnes**

@component('mail::subcopy')
Este email fue enviado para confirmar tu pedido #{{ $order->order_number }}. Si no realizaste este pedido, por favor contacta nuestro soporte inmediatamente.
@endcomponent
@endcomponentsage>
# Introduction

The body of your message.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
