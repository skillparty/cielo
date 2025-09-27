<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Pedido - {{ config('app.name') }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #4F46E5;
            margin-bottom: 10px;
        }
        .order-number {
            font-size: 18px;
            color: #666;
            font-weight: 500;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            margin: 15px 0;
        }
        .status-pending {
            background-color: #FEF3C7;
            color: #92400E;
        }
        .status-confirmed {
            background-color: #D1FAE5;
            color: #065F46;
        }
        .section {
            margin: 25px 0;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }
        .section-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #374151;
        }
        .item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .item:last-child {
            border-bottom: none;
        }
        .item-name {
            font-weight: 500;
        }
        .item-details {
            font-size: 14px;
            color: #666;
        }
        .total-section {
            background-color: #4F46E5;
            color: white;
            margin: 25px 0;
            padding: 20px;
            border-radius: 8px;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
        }
        .total-final {
            font-size: 18px;
            font-weight: bold;
            border-top: 1px solid rgba(255,255,255,0.3);
            padding-top: 10px;
            margin-top: 10px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 15px;
        }
        .info-item {
            background: white;
            padding: 15px;
            border-radius: 6px;
            border-left: 4px solid #4F46E5;
        }
        .info-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        .info-value {
            font-weight: 500;
            color: #333;
        }
        .address-block {
            background: white;
            padding: 15px;
            border-radius: 6px;
            border-left: 4px solid #10B981;
        }
        .button {
            display: inline-block;
            background-color: #4F46E5;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            text-align: center;
            margin: 10px 0;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #666;
            font-size: 14px;
        }
        .qr-notice {
            background-color: #FEF3C7;
            border: 1px solid #F59E0B;
            padding: 15px;
            border-radius: 6px;
            margin: 15px 0;
        }
        .qr-notice-title {
            font-weight: 600;
            color: #92400E;
            margin-bottom: 5px;
        }
        .qr-notice-text {
            color: #92400E;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">{{ config('app.name') }}</div>
            <h1>¡Nuevo Pedido Recibido!</h1>
            <div class="order-number">Pedido #{{ $order->order_number }}</div>
            <span class="status-badge {{ $order->status === 'confirmed' ? 'status-confirmed' : 'status-pending' }}">
                @if($order->status === 'pending_payment')
                    Esperando Confirmación de Pago
                @elseif($order->status === 'confirmed')
                    Pedido Confirmado
                @else
                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                @endif
            </span>
        </div>

        <div class="section">
            <div class="section-title">Información del Pedido</div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Fecha</div>
                    <div class="info-value">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Cliente</div>
                    <div class="info-value">{{ $order->user->name }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Email</div>
                    <div class="info-value">{{ $order->user->email }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Teléfono</div>
                    <div class="info-value">{{ $order->delivery_phone }}</div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="section-title">Dirección de Entrega</div>
            <div class="address-block">
                <div><strong>{{ $order->delivery_address_line1 }}</strong></div>
                @if($order->delivery_address_line2)
                    <div>{{ $order->delivery_address_line2 }}</div>
                @endif
                <div>{{ $order->delivery_city }}, {{ $order->delivery_state }}</div>
                @if($order->delivery_notes)
                    <div style="margin-top: 10px; font-style: italic; color: #666;">
                        <strong>Notas:</strong> {{ $order->delivery_notes }}
                    </div>
                @endif
            </div>
        </div>

        <div class="section">
            <div class="section-title">Productos Pedidos</div>
            @foreach($order->orderItems as $item)
                <div class="item">
                    <div>
                        <div class="item-name">{{ $item->product_name }}</div>
                        <div class="item-details">
                            Cantidad: {{ $item->quantity }} × Bs. {{ number_format($item->unit_price, 2) }}
                        </div>
                    </div>
                    <div><strong>Bs. {{ number_format($item->total_price, 2) }}</strong></div>
                </div>
            @endforeach
        </div>

        <div class="total-section">
            <div class="total-row">
                <span>Subtotal:</span>
                <span>Bs. {{ number_format($order->subtotal_amount, 2) }}</span>
            </div>
            <div class="total-row">
                <span>Envío:</span>
                <span>
                    @if($order->delivery_fee > 0)
                        Bs. {{ number_format($order->delivery_fee, 2) }}
                    @else
                        Gratis
                    @endif
                </span>
            </div>
            @if($order->tax_amount > 0)
                <div class="total-row">
                    <span>Impuestos:</span>
                    <span>Bs. {{ number_format($order->tax_amount, 2) }}</span>
                </div>
            @endif
            <div class="total-row total-final">
                <span>Total:</span>
                <span>Bs. {{ number_format($order->total_amount, 2) }}</span>
            </div>
        </div>

        @if($order->payments->count() > 0)
            <div class="section">
                <div class="section-title">Información de Pago</div>
                @foreach($order->payments as $payment)
                    <div class="item">
                        <div>
                            <div class="item-name">{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</div>
                            <div class="item-details">
                                Estado: {{ ucfirst($payment->status) }} - 
                                {{ $payment->created_at->format('d/m/Y H:i') }}
                            </div>
                            @if($payment->transaction_id)
                                <div class="item-details">ID: {{ $payment->transaction_id }}</div>
                            @endif
                        </div>
                        <div><strong>Bs. {{ number_format($payment->amount, 2) }}</strong></div>
                    </div>

                    @if($payment->payment_method === 'qr' && $payment->status === 'pending')
                        <div class="qr-notice">
                            <div class="qr-notice-title">Verificación de Pago QR</div>
                            <div class="qr-notice-text">
                                Hemos recibido el comprobante de pago. Nuestro equipo lo está verificando y te notificaremos cuando sea confirmado.
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('orders.show', $order) }}" class="button">
                Ver Detalles del Pedido
            </a>
        </div>

        <div class="section">
            <div class="section-title">¿Qué sigue?</div>
            @if($order->status === 'pending_payment')
                <p>📋 <strong>Verificación de pago:</strong> Estamos procesando tu comprobante de pago.</p>
                <p>📦 <strong>Preparación:</strong> Una vez confirmado el pago, prepararemos tu pedido.</p>
                <p>🚚 <strong>Envío:</strong> Te notificaremos cuando tu pedido esté en camino.</p>
                <p>📅 <strong>Entrega estimada:</strong> 2-3 días hábiles una vez confirmado el pago.</p>
            @else
                <p>✅ <strong>Pago confirmado:</strong> Tu pago ha sido verificado exitosamente.</p>
                <p>📦 <strong>Preparación:</strong> Estamos preparando tu pedido para el envío.</p>
                <p>🚚 <strong>Envío:</strong> Te notificaremos cuando tu pedido esté en camino.</p>
                <p>📅 <strong>Entrega estimada:</strong> 2-3 días hábiles.</p>
            @endif
        </div>

        <div class="footer">
            <p>Gracias por tu pedido en {{ config('app.name') }}</p>
            <p>Si tienes preguntas, puedes contactarnos respondiendo a este email.</p>
            <p style="margin-top: 20px; font-size: 12px; color: #999;">
                Este es un email automático, por favor no respondas directamente.
            </p>
        </div>
    </div>
</body>
</html>