<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'admin_notes',
        'assigned_to',
        'resolved_at',
        'metadata',
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
        'metadata' => 'array',
    ];

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeUnresolved($query)
    {
        return $query->whereIn('status', ['new', 'in_progress']);
    }

    public function scopeAssignedTo($query, $userId)
    {
        return $query->where('assigned_to', $userId);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function markAsResolved(): void
    {
        $this->update([
            'status' => 'resolved',
            'resolved_at' => now(),
        ]);
    }

    public function assignTo(User $user): void
    {
        $this->update([
            'assigned_to' => $user->id,
            'status' => 'in_progress',
        ]);
    }
}
