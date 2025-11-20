<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'description', 
        'price',
        'duration_days',
        'daily_limit',
        'quality_limit',
        'ads_enabled',
        'download_enabled',
        'features',
        'status'
    ];

    protected $casts = [
        'features' => 'array',
        'price' => 'decimal:2',
        'ads_enabled' => 'boolean',
        'download_enabled' => 'boolean'
    ];

    // Scope để lấy gói free
    public function scopeFree($query)
    {
        return $query->where('type', 'free');
    }

    // Scope để lấy gói premium
    public function scopePremium($query)
    {
        return $query->where('type', 'premium');
    }

    // Scope để lấy gói active
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_packages')
                    ->withPivot('start_date', 'end_date', 'payment_status', 'transaction_id', 'amount')
                    ->withTimestamps();
    }

    public function activeSubscriptions()
    {
        return $this->hasMany(UserPackage::class)->where('end_date', '>', now());
    }

    // Get quality text
    public function getQualityTextAttribute()
    {
        $qualities = [
            1 => 'SD (480p)',
            2 => 'HD (720p)',
            3 => 'Full HD (1080p)',
            4 => '4K (2160p)'
        ];
        return $qualities[$this->quality_limit] ?? 'SD';
    }
}