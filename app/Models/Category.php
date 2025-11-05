<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	
    use HasFactory;
    public $timestamps = false;
    public function movie(){

    	return $this->hasMany(Movie::class)->orderBy('id','DESC');
    }   //hasMany: Một bản ghi (category) có nhiều bản ghi khác (movies)
        //orderBy('id','DESC): sắp xếp id giảm dần
}
