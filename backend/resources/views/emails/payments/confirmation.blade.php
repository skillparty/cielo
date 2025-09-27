@component('mail::message')
# ✅ Pago Confirmado

Hola **{{ $customer->name }}**,

¡Excelente noticia! Hemos confirmado el pago de tu pedido.

## Detalles del Pago

**Pedido:** #{{ $order->order_number }}  
**Monto Pagado:** Bs. {{ number_format($payment->amount, 2) }}  
**Método de Pago:** {{ ucfirst($payment->method) }}  
**Fecha de Pago:** {{ $payment->updated_at->format('d/m/Y H:i') }}  
**Estado:** Confirmado ✅

@if($payment->method === 'qr')
## Información del Pago QR

**Referencia:** {{ $payment->gateway_reference ?? 'N/A' }}  
Tu comprobante ha sido verificado y aprobado exitosamente.
@endif

@if($payment->method === 'card')
## Información del Pago con Tarjeta

**ID de Transacción:** {{ $payment->gateway_transaction_id }}  
**Referencia:** {{ $payment->gateway_reference }}
@endif

## ¿Qué sigue?

Ahora que tu pago ha sido confirmado:

1. **Preparación:** Comenzaremos a preparar tu pedido inmediatamente
2. **Notificación:** Te informaremos cuando esté listo para entrega
3. **Entrega:** Nuestro equipo se pondrá en contacto para coordinar la entrega

@component('mail::button', ['url' => route('orders.show', $order)])
Ver Estado del Pedido
@endcomponent

## Información de Entrega

**Dirección:** {{ $order->shipping_address_line1 }}  
**Ciudad:** {{ $order->shipping_city }}  
**Tiempo Estimado:** 2-4 horas

¡Gracias por tu confianza en Cielo Carnes! 🥩

Saludos,  
**El equipo de Cielo Carnes**

@component('mail::subcopy')
Este email confirma el pago del pedido #{{ $order->order_number }}. Si no reconoces esta transacción, contacta nuestro soporte inmediatamente.
@endcomponent
@endcomponent
