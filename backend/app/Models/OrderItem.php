<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price_at_time',
        'total',
        'product_snapshot',
    ];

    protected $casts = [
        'price_at_time' => 'decimal:2',
        'total' => 'decimal:2',
        'quantity' => 'integer',
        'product_snapshot' => 'array',
    ];

    // Relaciones
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // Métodos de utilidad
    public function calculateTotal(): float
    {
        return $this->quantity * $this->price_at_time;
    }

    public function getProductNameAttribute(): string
    {
        // Si el producto fue eliminado, usar el snapshot
        if (!$this->product && $this->product_snapshot) {
            return $this->product_snapshot['name'] ?? 'Producto eliminado';
        }
        
        return $this->product->name ?? 'Producto no encontrado';
    }

    public function getProductImageAttribute(): ?string
    {
        if ($this->product) {
            return $this->product->getFirstMediaUrl('images');
        }

        // Si el producto fue eliminado, usar el snapshot
        if ($this->product_snapshot && isset($this->product_snapshot['image'])) {
            return $this->product_snapshot['image'];
        }

        return null;
    }

    // Boot method para calcular el total automáticamente
    public static function boot()
    {
        parent::boot();
        
        static::saving(function ($orderItem) {
            $orderItem->total = $orderItem->calculateTotal();
        });
    }
}