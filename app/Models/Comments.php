<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'comments';
    protected $fillable = [
    	'visitor_id', 'comment', 'movie_id','status','name','email','date_created'
    ];
    public function movie(){

    	return $this->belongsTo(Movie::class);
    }
}
