@component('mail::message')
# 🔔 Nuevo Pedido Recibido

Se ha recibido un nuevo pedido en el sistema.

## Información del Pedido

**Número:** {{ $order->order_number }}  
**Cliente:** {{ $customer->name }}  
**Email:** {{ $customer->email }}  
**Teléfono:** {{ $customer->phone }}  
**Total:** Bs. {{ number_format($order->total, 2) }}  
**Método de Pago:** {{ ucfirst($payment->method) }}  
**Estado del Pago:** {{ ucfirst($payment->status) }}

## Productos Pedidos

@component('mail::table')
| Producto | Cantidad | Precio | Subtotal |
|:---------|:---------|:-------|:---------|
@foreach($items as $item)
| {{ $item->product->name }} | {{ $item->quantity }} | Bs. {{ number_format($item->price, 2) }} | Bs. {{ number_format($item->quantity * $item->price, 2) }} |
@endforeach
@endcomponent

## Información de Entrega

**Dirección:**  
{{ $order->shipping_address_line1 }}  
@if($order->shipping_address_line2)
{{ $order->shipping_address_line2 }}  
@endif
{{ $order->shipping_city }}, {{ $order->shipping_state }}

@if($payment->method === 'qr' && $payment->status === 'pending')
@component('mail::panel')
⚠️ **Atención:** Este pedido requiere verificación de pago QR.
@endcomponent
@endif

@component('mail::button', ['url' => route('admin.orders.show', $order)])
Ver Pedido en Admin
@endcomponent

## Acciones Requeridas

- [ ] Verificar disponibilidad de productos
- [ ] Confirmar pago (si es necesario)
- [ ] Actualizar estado del pedido
- [ ] Coordinar preparación y entrega

---

**Sistema de Notificaciones - Cielo Carnes**

@component('mail::subcopy')
Esta es una notificación automática del sistema. Pedido #{{ $order->order_number }} recibido el {{ $order->created_at->format('d/m/Y H:i') }}.
@endcomponent
@endcomponent
