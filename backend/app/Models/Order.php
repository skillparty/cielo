<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'status',
        'subtotal',
        'tax_amount',
        'delivery_fee',
        'discount_amount',
        'total',
        'currency',
        'payment_method',
        'delivery_address_line1',
        'delivery_address_line2',
        'delivery_city',
        'delivery_state',
        'delivery_postal_code',
        'delivery_phone',
        'delivery_notes',
        'estimated_delivery_at',
        'delivered_at',
        'metadata',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'delivery_fee' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total' => 'decimal:2',
        'estimated_delivery_at' => 'datetime',
        'delivered_at' => 'datetime',
        'metadata' => 'array',
    ];

    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = static::generateOrderNumber();
            }
        });

        static::created(function ($order) {
            // Dispatch event for new order
            event(new \App\Events\OrderCreated($order));
        });

        static::updating(function ($order) {
            // Check if status is changing
            if ($order->isDirty('status')) {
                $order->previous_status = $order->getOriginal('status');
            }
        });

        static::updated(function ($order) {
            // Dispatch event for status change
            if (isset($order->previous_status) && $order->previous_status !== $order->status) {
                event(new \App\Events\OrderStatusChanged($order, $order->previous_status));
            }
        });
    }

    public static function generateOrderNumber(): string
    {
        do {
            $number = 'ORD-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));
        } while (static::where('order_number', $number)->exists());
        
        return $number;
    }

    // Relaciones
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    // Métodos de utilidad
    public function isPaid(): bool
    {
        return $this->payment && $this->payment->status === 'completed';
    }

    public function canBeCancelled(): bool
    {
        return in_array($this->status, ['pending', 'payment_pending', 'payment_verification']);
    }

    public function getTotalItemsAttribute(): int
    {
        return $this->orderItems->sum('quantity');
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending', 'payment_pending' => 'yellow',
            'payment_verification' => 'blue',
            'paid', 'preparing' => 'green',
            'ready_for_delivery', 'out_for_delivery' => 'indigo',
            'delivered' => 'green',
            'cancelled', 'refunded' => 'red',
            default => 'gray'
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Pendiente',
            'payment_pending' => 'Pago Pendiente',
            'payment_verification' => 'Verificando Pago',
            'paid' => 'Pagado',
            'preparing' => 'Preparando',
            'ready_for_delivery' => 'Listo para Entrega',
            'out_for_delivery' => 'En Camino',
            'delivered' => 'Entregado',
            'cancelled' => 'Cancelado',
            'refunded' => 'Reembolsado',
            default => ucfirst($this->status)
        };
    }
}
