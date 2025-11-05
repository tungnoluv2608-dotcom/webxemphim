<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    
	public $timestamps = false;
   
    use HasFactory;
    public function category(){
    	return $this->belongsTo(Category::class,'category_id');
    }   //belongsTo:một movie thuộc về một category
    public function country(){
    	return $this->belongsTo(Country::class,'country_id');
    }
    public function genre(){
    	return $this->belongsTo(Genre::class,'genre_id');
    }
    public function movie_genre(){
        return $this->belongsToMany(Genre::class,'movie_genre','movie_id','genre_id');
    }
    public function episode(){
        return $this->hasMany(Episode::class);
    }
    public function getepisode() 
    {
        return $this->withCount('episode')->get()->where('server','3');
    }
}
