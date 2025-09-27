<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price_at_time',
        'notes',
    ];

    protected $casts = [
        'price_at_time' => 'decimal:2',
        'quantity' => 'integer',
    ];

    // Relaciones
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // Métodos de utilidad
    public function getTotalAttribute(): float
    {
        return $this->quantity * $this->price_at_time;
    }

    public function updateQuantity(int $quantity): bool
    {
        if ($quantity <= 0) {
            return $this->delete();
        }

        // Verificar stock disponible
        if ($this->product && $quantity > $this->product->stock_quantity) {
            return false;
        }

        $this->quantity = $quantity;
        return $this->save();
    }

    public function canIncrease(int $amount = 1): bool
    {
        return $this->product && ($this->quantity + $amount) <= $this->product->stock_quantity;
    }

    // Scope para el carrito del usuario actual
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Método estático para obtener el total del carrito
    public static function getTotalForUser($userId): float
    {
        return static::forUser($userId)
            ->with('product')
            ->get()
            ->sum('total');
    }

    // Método estático para obtener el número de items en el carrito
    public static function getItemCountForUser($userId): int
    {
        return static::forUser($userId)->sum('quantity');
    }

    // Método estático para limpiar el carrito
    public static function clearForUser($userId): bool
    {
        return static::forUser($userId)->delete();
    }
}
