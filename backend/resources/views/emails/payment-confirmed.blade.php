<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Confirmado - {{ config('app.name') }}</title>
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
        .success-icon {
            width: 60px;
            height: 60px;
            background-color: #10B981;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 30px;
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
        .highlight-section {
            background: linear-gradient(135deg, #10B981, #059669);
            color: white;
            margin: 25px 0;
            padding: 25px;
            border-radius: 10px;
            text-align: center;
        }
        .highlight-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .highlight-text {
            font-size: 16px;
            opacity: 0.9;
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
            border-left: 4px solid #10B981;
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
        .payment-info {
            background: #EFF6FF;
            border: 1px solid #DBEAFE;
            padding: 20px;
            border-radius: 8px;
            margin: 15px 0;
        }
        .payment-title {
            font-weight: 600;
            color: #1E40AF;
            margin-bottom: 10px;
        }
        .payment-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .payment-detail {
            color: #1E40AF;
            font-size: 14px;
        }
        .timeline {
            position: relative;
            margin: 20px 0;
        }
        .timeline-item {
            display: flex;
            align-items: center;
            margin: 15px 0;
            position: relative;
        }
        .timeline-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
            margin-right: 15px;
            flex-shrink: 0;
        }
        .timeline-icon.completed {
            background-color: #10B981;
            color: white;
        }
        .timeline-icon.current {
            background-color: #3B82F6;
            color: white;
        }
        .timeline-icon.pending {
            background-color: #E5E7EB;
            color: #6B7280;
        }
        .timeline-content {
            flex: 1;
        }
        .timeline-title {
            font-weight: 500;
            color: #374151;
        }
        .timeline-desc {
            font-size: 14px;
            color: #6B7280;
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
            margin: 10px 5px;
        }
        .button-secondary {
            background-color: #6B7280;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #666;
            font-size: 14px;
        }
        .tracking-info {
            background: #FEF3C7;
            border: 1px solid #F59E0B;
            padding: 15px;
            border-radius: 6px;
            margin: 15px 0;
            text-align: center;
        }
        .tracking-title {
            font-weight: 600;
            color: #92400E;
            margin-bottom: 5px;
        }
        .tracking-text {
            color: #92400E;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">{{ config('app.name') }}</div>
            <div class="success-icon">✓</div>
            <h1>¡Pago Confirmado!</h1>
            <div class="order-number">Pedido #{{ $order->order_number }}</div>
            <span class="status-badge">Pedido Confirmado</span>
        </div>

        <div class="highlight-section">
            <div class="highlight-title">Tu pago ha sido verificado exitosamente</div>
            <div class="highlight-text">
                Gracias {{ $order->user->name }}. Tu pedido está siendo preparado para el envío.
            </div>
        </div>

        @if($payment)
            <div class="section">
                <div class="section-title">Detalles del Pago</div>
                <div class="payment-info">
                    <div class="payment-title">{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</div>
                    <div class="payment-details">
                        <div class="payment-detail">
                            <strong>Monto:</strong> Bs. {{ number_format($payment->amount, 2) }}
                        </div>
                        <div class="payment-detail">
                            <strong>Estado:</strong> {{ ucfirst($payment->status) }}
                        </div>
                        @if($payment->transaction_id)
                            <div class="payment-detail">
                                <strong>ID Transacción:</strong> {{ $payment->transaction_id }}
                            </div>
                        @endif
                        <div class="payment-detail">
                            <strong>Fecha:</strong> {{ $payment->updated_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="section">
            <div class="section-title">Información del Pedido</div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Número de Pedido</div>
                    <div class="info-value">#{{ $order->order_number }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Total del Pedido</div>
                    <div class="info-value">Bs. {{ number_format($order->total_amount, 2) }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Fecha del Pedido</div>
                    <div class="info-value">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Método de Envío</div>
                    <div class="info-value">Entrega a Domicilio</div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="section-title">Estado del Pedido</div>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-icon completed">✓</div>
                    <div class="timeline-content">
                        <div class="timeline-title">Pedido Recibido</div>
                        <div class="timeline-desc">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-icon completed">✓</div>
                    <div class="timeline-content">
                        <div class="timeline-title">Pago Confirmado</div>
                        <div class="timeline-desc">{{ now()->format('d/m/Y H:i') }}</div>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-icon current">2</div>
                    <div class="timeline-content">
                        <div class="timeline-title">Preparando Pedido</div>
                        <div class="timeline-desc">En proceso - Te notificaremos cuando esté listo</div>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-icon pending">3</div>
                    <div class="timeline-content">
                        <div class="timeline-title">En Camino</div>
                        <div class="timeline-desc">Te notificaremos cuando tu pedido esté en camino</div>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-icon pending">4</div>
                    <div class="timeline-content">
                        <div class="timeline-title">Entregado</div>
                        <div class="timeline-desc">Entrega estimada: 2-3 días hábiles</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tracking-info">
            <div class="tracking-title">📦 Preparando tu Pedido</div>
            <div class="tracking-text">
                Nuestro equipo está preparando cuidadosamente tu pedido. 
                Te enviaremos otra notificación cuando esté listo para el envío.
            </div>
        </div>

        <div class="section">
            <div class="section-title">Dirección de Entrega</div>
            <div style="background: white; padding: 15px; border-radius: 6px; border-left: 4px solid #10B981;">
                <div><strong>{{ $order->delivery_address_line1 }}</strong></div>
                @if($order->delivery_address_line2)
                    <div>{{ $order->delivery_address_line2 }}</div>
                @endif
                <div>{{ $order->delivery_city }}, {{ $order->delivery_state }}</div>
                <div style="margin-top: 10px;">
                    <strong>Teléfono:</strong> {{ $order->delivery_phone }}
                </div>
                @if($order->delivery_notes)
                    <div style="margin-top: 10px; font-style: italic; color: #666;">
                        <strong>Notas:</strong> {{ $order->delivery_notes }}
                    </div>
                @endif
            </div>
        </div>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('orders.show', $order) }}" class="button">
                Ver Detalles del Pedido
            </a>
            <a href="{{ route('dashboard') }}" class="button button-secondary">
                Ir al Panel Principal
            </a>
        </div>

        <div class="section">
            <div class="section-title">¿Necesitas Ayuda?</div>
            <p>Si tienes alguna pregunta sobre tu pedido, no dudes en contactarnos:</p>
            <ul style="list-style: none; padding: 0;">
                <li style="margin: 8px 0;">📧 Email: soporte@cielonatural.com</li>
                <li style="margin: 8px 0;">📱 WhatsApp: +591 7123-4567</li>
                <li style="margin: 8px 0;">🕒 Horario: Lunes a Viernes, 9:00 AM - 6:00 PM</li>
            </ul>
        </div>

        <div class="footer">
            <p><strong>¡Gracias por tu confianza en {{ config('app.name') }}!</strong></p>
            <p>Estamos comprometidos en ofrecerte los mejores productos naturales y el mejor servicio.</p>
            <p style="margin-top: 20px; font-size: 12px; color: #999;">
                Este es un email automático, por favor no respondas directamente. 
                Para soporte, usa los canales mencionados arriba.
            </p>
        </div>
    </div>
</body>
</html>