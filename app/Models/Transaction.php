<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'paid_amount',
        'parent_email',
        'parent_id',
        'currency',
        'status_code',
        'payment_date',
        'parent_identification',
    ];

    const AUTHORIZED = 1;
    const DECLINE = 2;
    const REFUNDED = 3;

    public function scopeStatus($query, $status)
    {
        switch ($status) {
            case 'authorized':
                return $query->where('status_code', self::AUTHORIZED);
                break;
            case 'decline':
                return $query->where('status_code', self::DECLINE);
                break;
            case 'refunded':
                return $query->where('status_code', self::REFUNDED);
                break;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }
    public function userEmail()
    {
        return $this->belongsTo(User::class, 'parent_email', 'email');
    }
}
