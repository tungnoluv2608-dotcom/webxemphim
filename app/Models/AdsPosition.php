<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsPosition extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'ads_position';
    
    protected $fillable = [
    	'ads_position_name', 'ads_position_status', 'ads_order'
    ];
}
