<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsNetWorkScript extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'adsnetwork_scripts';
    protected $fillable = [
    	'title', 'adsnetwork_id', 'status','script'
    ];
    public function adsnetwork(){

    	return $this->belongsTo(AdsNetWork::class,'adsnetwork_id');
    }
}
