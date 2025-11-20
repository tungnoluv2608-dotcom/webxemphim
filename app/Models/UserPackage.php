<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id', 
        'start_date',
        'end_date',
        'payment_status',
        'transaction_id',
        'amount',
        'payment_info'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'amount' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    // Scope để lấy gói đang hoạt động
    public function scopeActive($query)
    {
        return $query->where('payment_status', 'paid')
                    ->where('end_date', '>', now());
    }
}