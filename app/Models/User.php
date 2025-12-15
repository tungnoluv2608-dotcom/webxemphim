<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'facebook_id',
        'avatar',
        'is_vip',
        'vip_expired_at',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean'
    ];
    public function packages()
    {
        return $this->belongsToMany(Package::class, 'user_packages')
                    ->withPivot('start_date', 'end_date', 'payment_status', 'transaction_id', 'amount')
                    ->withTimestamps();
    }

    public function userPackages()
    {
        return $this->hasMany(UserPackage::class);
    }

    // Lấy gói dịch vụ hiện tại đang hoạt động
    public function currentPackage()
    {
        return $this->hasOne(UserPackage::class)
                    ->where('payment_status', 'paid')
                    ->where('end_date', '>', now())
                    ->latest();
    }

    // Kiểm tra user có đang sử dụng gói nào không
    public function hasActivePackage()
    {
        return $this->currentPackage()->exists();
    }
    public function getAvatarUrlAttribute()
    {
        if (!$this->avatar) {
            return null;
        }
        
        // Nếu avatar đã là URL đầy đủ (Google, Facebook avatar)
        if (filter_var($this->avatar, FILTER_VALIDATE_URL)) {
            return $this->avatar;
        }
        
        // Nếu avatar là đường dẫn trong storage
        if (strpos($this->avatar, 'avatars/') === 0 || strpos($this->avatar, 'public/avatars/') === 0) {
            return asset('storage/' . $this->avatar);
        }
        
        // Mặc định trả về đường dẫn từ public folder
        return asset($this->avatar);
    }

    /**
     * Get the first letter of user's name for default avatar
     */
    public function getInitialAttribute()
    {
        return strtoupper(substr($this->name, 0, 1));
    }
    public function isAdmin()
    {
        return $this->is_admin === true;
    }
    // User.php
public function isVipActive()
{
    return $this->is_vip && $this->vip_expired_at && \Carbon\Carbon::parse($this->vip_expired_at) > now();
}
}
