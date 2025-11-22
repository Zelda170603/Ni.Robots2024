<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoCall extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'call_type',
        'channel_name',
        'status',
        'expires_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'expires_at' => 'datetime',
    ];

    /**
     * Get the user who initiated the call.
     */
    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    /**
     * Get the user who received the call.
     */
    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    /**
     * Scope a query to only include active calls.
     */
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['ringing', 'accepted'])
                    ->where('expires_at', '>', now());
    }

    /**
     * Scope a query to only include ringing calls.
     */
    public function scopeRinging($query)
    {
        return $query->where('status', 'ringing')
                    ->where('expires_at', '>', now());
    }

    /**
     * Scope a query to only include calls between two users.
     */
    public function scopeBetweenUsers($query, $userId1, $userId2)
    {
        return $query->where(function($q) use ($userId1, $userId2) {
            $q->where('from_user_id', $userId1)
              ->where('to_user_id', $userId2);
        })->orWhere(function($q) use ($userId1, $userId2) {
            $q->where('from_user_id', $userId2)
              ->where('to_user_id', $userId1);
        });
    }

    /**
     * Check if the call is expired.
     */
    public function isExpired()
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    /**
     * Check if the call is active (ringing or accepted and not expired).
     */
    public function isActive()
    {
        return in_array($this->status, ['ringing', 'accepted']) && !$this->isExpired();
    }

    /**
     * Check if the call can be accepted.
     */
    public function canBeAccepted()
    {
        return $this->status === 'ringing' && !$this->isExpired();
    }

    /**
     * Mark the call as ended.
     */
    public function markAsEnded()
    {
        $this->update(['status' => 'ended']);
    }

    /**
     * Extend the call expiration time.
     */
    public function extendExpiration($minutes = 60)
    {
        $this->update([
            'expires_at' => now()->addMinutes($minutes)
        ]);
    }
}