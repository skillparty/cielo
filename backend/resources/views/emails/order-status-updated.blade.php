<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualización de Pedido - {{ config('app.name') }}</title>
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
        .status-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 30px;
        }
        .status-processing {
            background-color: #3B82F6;
        }
        .status-shipped {
            background-color: #8B5CF6;
        }
        .status-delivered {
            background-color: #10B981;
        }
        .status-cancelled {
            background-color: #EF4444;
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
        .status-processing-badge {
            background-color: #DBEAFE;
            color: #1E40AF;
        }
        .status-shipped-badge {
            background-color: #E0E7FF;
            color: #5B21B6;
        }
        .status-delivered-badge {
            background-color: #D1FAE5;
            color: #065F46;
        }
        .status-cancelled-badge {
            background-color: #FEE2E2;
            color: #B91C1C;
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
            margin: 25px 0;
            padding: 25px;
            border-radius: 10px;
            text-align: center;
        }
        .highlight-processing {
            background: linear-gradient(135deg, #3B82F6, #2563EB);
            color: white;
        }
        .highlight-shipped {
            background: linear-gradient(135deg, #8B5CF6, #7C3AED);
            color: white;
        }
        .highlight-delivered {
            background: linear-gradient(135deg, #10B981, #059669);
            color: white;
        }
        .highlight-cancelled {
            background: linear-gradient(135deg, #EF4444, #DC2626);
            color: white;
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
        }
        .info-item-processing {
            border-left: 4px solid #3B82F6;
        }
        .info-item-shipped {
            border-left: 4px solid #8B5CF6;
        }
        .info-item-delivered {
            border-left: 4px solid #10B981;
        }
        .info-item-cancelled {
            border-left: 4px solid #EF4444;
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
        .tracking-section {
            padding: 20px;
            border-radius: 8px;
            margin: 15px 0;
            text-align: center;
        }
        .tracking-processing {
            background: #EFF6FF;
            border: 1px solid #DBEAFE;
        }
        .tracking-shipped {
            background: #F3E8FF;
            border: 1px solid #E9D5FF;
        }
        .tracking-delivered {
            background: #ECFDF5;
            border: 1px solid #D1FAE5;
        }
        .tracking-cancelled {
            background: #FEF2F2;
            border: 1px solid #FECACA;
        }
        .tracking-title {
            font-weight: 600;
            margin-bottom: 10px;
        }
        .tracking-processing-title {
            color: #1E40AF;
        }
        .tracking-shipped-title {
            color: #5B21B6;
        }
        .tracking-delivered-title {
            color: #065F46;
        }
        .tracking-cancelled-title {
            color: #B91C1C;
        }
        .tracking-text {
            font-size: 14px;
        }
        .tracking-processing-text {
            color: #1E40AF;
        }
        .tracking-shipped-text {
            color: #5B21B6;
        }
        .tracking-delivered-text {
            color: #065F46;
        }
        .tracking-cancelled-text {
            color: #B91C1C;
        }
        .tracking-code {
            background: white;
            padding: 10px;
            border-radius: 4px;
            font-family: monospace;
            font-weight: bold;
            margin: 10px 0;
            border: 1px solid #E5E7EB;
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
        .notes-section {
            background: #FEF3C7;
            border: 1px solid #F59E0B;
            padding: 15px;
            border-radius: 6px;
            margin: 15px 0;
        }
        .notes-title {
            font-weight: 600;
            color: #92400E;
            margin-bottom: 5px;
        }
        .notes-text {
            color: #92400E;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">{{ config('app.name') }}</div>
            
            @if($order->status === 'processing')
                <div class="status-icon status-processing">📦</div>
                <h1>¡Tu Pedido está en Preparación!</h1>
            @elseif($order->status === 'shipped')
                <div class="status-icon status-shipped">🚚</div>
                <h1>¡Tu Pedido está en Camino!</h1>
            @elseif($order->status === 'delivered')
                <div class="status-icon status-delivered">✅</div>
                <h1>¡Tu Pedido ha sido Entregado!</h1>
            @elseif($order->status === 'cancelled')
                <div class="status-icon status-cancelled">❌</div>
                <h1>Pedido Cancelado</h1>
            @endif
            
            <div class="order-number">Pedido #{{ $order->order_number }}</div>
            <span class="status-badge status-{{ $order->status }}-badge">
                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
            </span>
        </div>

        @if($order->status === 'processing')
            <div class="highlight-section highlight-processing">
                <div class="highlight-title">Preparando tu Pedido</div>
                <div class="highlight-text">
                    Hola {{ $order->user->name }}, tu pedido está siendo preparado cuidadosamente por nuestro equipo.
                </div>
            </div>
            
            <div class="tracking-section tracking-processing">
                <div class="tracking-title tracking-processing-title">📦 Estado: En Preparación</div>
                <div class="tracking-text tracking-processing-text">
                    Nuestro equipo está seleccionando y empacando tus productos. 
                    Te notificaremos cuando esté listo para el envío.
                </div>
            </div>

        @elseif($order->status === 'shipped')
            <div class="highlight-section highlight-shipped">
                <div class="highlight-title">¡Tu Pedido está en Camino!</div>
                <div class="highlight-text">
                    Hola {{ $order->user->name }}, tu pedido ha salido de nuestro almacén y está en camino hacia ti.
                </div>
            </div>
            
            <div class="tracking-section tracking-shipped">
                <div class="tracking-title tracking-shipped-title">🚚 Estado: En Tránsito</div>
                <div class="tracking-text tracking-shipped-text">
                    Tu pedido está siendo transportado a tu dirección. 
                    Recibirás tu pedido en las próximas horas.
                </div>
                @if($order->tracking_number)
                    <div class="tracking-code">
                        Código de Seguimiento: {{ $order->tracking_number }}
                    </div>
                @endif
            </div>

        @elseif($order->status === 'delivered')
            <div class="highlight-section highlight-delivered">
                <div class="highlight-title">¡Entrega Completada!</div>
                <div class="highlight-text">
                    Hola {{ $order->user->name }}, tu pedido ha sido entregado exitosamente. 
                    ¡Esperamos que disfrutes tus productos!
                </div>
            </div>
            
            <div class="tracking-section tracking-delivered">
                <div class="tracking-title tracking-delivered-title">✅ Estado: Entregado</div>
                <div class="tracking-text tracking-delivered-text">
                    Tu pedido fue entregado el {{ $order->delivered_at ? $order->delivered_at->format('d/m/Y H:i') : now()->format('d/m/Y H:i') }}.
                    ¡Gracias por tu compra!
                </div>
            </div>

        @elseif($order->status === 'cancelled')
            <div class="highlight-section highlight-cancelled">
                <div class="highlight-title">Pedido Cancelado</div>
                <div class="highlight-text">
                    Hola {{ $order->user->name }}, lamentamos informarte que tu pedido ha sido cancelado.
                </div>
            </div>
            
            <div class="tracking-section tracking-cancelled">
                <div class="tracking-title tracking-cancelled-title">❌ Estado: Cancelado</div>
                <div class="tracking-text tracking-cancelled-text">
                    Tu pedido ha sido cancelado. Si realizaste un pago, 
                    el reembolso será procesado en los próximos 3-5 días hábiles.
                </div>
            </div>
        @endif

        <div class="section">
            <div class="section-title">Información del Pedido</div>
            <div class="info-grid">
                <div class="info-item info-item-{{ $order->status }}">
                    <div class="info-label">Número de Pedido</div>
                    <div class="info-value">#{{ $order->order_number }}</div>
                </div>
                <div class="info-item info-item-{{ $order->status }}">
                    <div class="info-label">Total del Pedido</div>
                    <div class="info-value">Bs. {{ number_format($order->total_amount, 2) }}</div>
                </div>
                <div class="info-item info-item-{{ $order->status }}">
                    <div class="info-label">Fecha del Pedido</div>
                    <div class="info-value">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                </div>
                <div class="info-item info-item-{{ $order->status }}">
                    <div class="info-label">Última Actualización</div>
                    <div class="info-value">{{ $order->updated_at->format('d/m/Y H:i') }}</div>
                </div>
            </div>
        </div>

        @if($order->status !== 'delivered' && $order->status !== 'cancelled')
            <div class="section">
                <div class="section-title">Dirección de Entrega</div>
                <div style="background: white; padding: 15px; border-radius: 6px; border-left: 4px solid #{{ $order->status === 'processing' ? '3B82F6' : '8B5CF6' }};">
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
        @endif

        @if(!empty($statusNotes))
            <div class="notes-section">
                <div class="notes-title">Notas Adicionales</div>
                <div class="notes-text">{{ $statusNotes }}</div>
            </div>
        @endif

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('orders.show', $order) }}" class="button">
                Ver Detalles del Pedido
            </a>
            
            @if($order->status === 'delivered')
                <a href="{{ route('products.index') }}" class="button button-secondary">
                    Seguir Comprando
                </a>
            @elseif($order->status !== 'cancelled')
                <a href="{{ route('dashboard') }}" class="button button-secondary">
                    Ir al Panel Principal
                </a>
            @endif
        </div>

        @if($order->status === 'delivered')
            <div class="section">
                <div class="section-title">¡Cuéntanos tu Experiencia!</div>
                <p>Nos encantaría conocer tu opinión sobre los productos que recibiste. 
                Tu feedback nos ayuda a mejorar nuestros servicios.</p>
                <div style="text-align: center; margin-top: 15px;">
                    <a href="#" class="button" style="background-color: #F59E0B;">
                        Dejar una Reseña
                    </a>
                </div>
            </div>
        @endif

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
            <p><strong>Gracias por elegir {{ config('app.name') }}</strong></p>
            @if($order->status === 'delivered')
                <p>Esperamos que disfrutes tus productos naturales y que vuelvas pronto.</p>
            @else
                <p>Estamos trabajando para que recibas tu pedido lo antes posible.</p>
            @endif
            <p style="margin-top: 20px; font-size: 12px; color: #999;">
                Este es un email automático, por favor no respondas directamente. 
                Para soporte, usa los canales mencionados arriba.
            </p>
        </div>
    </div>
</body>
</html>