<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'payment_method',
        'status',
        'amount',
        'currency',
        'gateway_transaction_id',
        'gateway_reference',
        'gateway_response',
        'receipt_file_path',
        'ocr_data',
        'verification_status',
        'verification_notes',
        'verified_at',
        'verified_by',
        'metadata',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'gateway_response' => 'array',
        'ocr_data' => 'array',
        'verified_at' => 'datetime',
        'metadata' => 'array',
    ];

    public static function boot()
    {
        parent::boot();
        
        static::updated(function ($payment) {
            // Check if status changed to completed
            if ($payment->isDirty('status') && $payment->status === 'completed') {
                event(new \App\Events\PaymentConfirmed($payment));
            }
        });
    }

    // Relaciones
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    // Métodos de utilidad
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function requiresVerification(): bool
    {
        return $this->payment_method === 'qr' && in_array($this->verification_status, ['pending', 'manual_review']);
    }

    public function getReceiptUrlAttribute(): ?string
    {
        if ($this->receipt_file_path && Storage::exists($this->receipt_file_path)) {
            return Storage::url($this->receipt_file_path);
        }
        return null;
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending', 'processing' => 'yellow',
            'completed' => 'green',
            'failed', 'cancelled' => 'red',
            'refunded' => 'orange',
            'verification_required' => 'blue',
            default => 'gray'
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Pendiente',
            'processing' => 'Procesando',
            'completed' => 'Completado',
            'failed' => 'Fallido',
            'cancelled' => 'Cancelado',
            'refunded' => 'Reembolsado',
            'verification_required' => 'Requiere Verificación',
            default => ucfirst($this->status)
        };
    }

    public function getPaymentMethodLabelAttribute(): string
    {
        return match($this->payment_method) {
            'card' => 'Tarjeta de Crédito/Débito',
            'qr' => 'Código QR',
            'cash_on_delivery' => 'Efectivo Contra Entrega',
            default => ucfirst($this->payment_method)
        };
    }
}
