<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'ads';
    protected $fillable = [
    	'ads_name', 'ads_position', 'ads_link','ads_gif','ads_status'
    ];

    public function ads_position(){
        return $this->belongsTo(AdsPosition::class,'ads_position','id');
    }
}
