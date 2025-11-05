<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory; //Dùng để tạo dữ liệu mẫu (factory)
    public $timestamps = false; //Tắt tự động cập nhật cột created_at và updated_at. Bởi vì bảng ads không có hai cột này.
    protected $table = 'ads'; //Lk bảng ads
    protected $fillable = [
    	'ads_name', 'ads_position', 'ads_link','ads_gif','ads_status'
    ]; //Chỉ liên kết với các cột này

    public function ads_position(){
        return $this->belongsTo(AdsPosition::class,'ads_position','id');
    }   //Định nghĩa mối quan hệ giữa bảng "ads" và bảng "ads_positions".
}
