<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VipOrder extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'transaction_no',
        'bank_code',
        'status',
        'expiry_date',
        'order_code', 

    ];
    public function user() {
    return $this->belongsTo(User::class);
}
}
