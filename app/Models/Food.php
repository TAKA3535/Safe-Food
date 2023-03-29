<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';
    // public $timestamps = false;
    // protected $dates = ['limit_date', 'alert'];

    // 商品追加ホワイトリスト
    protected $fillable = [
        'id',
        'info',
        'image',
        'category_id',
        'limit_date',
        'alart',
        'user_id',
    ];

    // Userモデルを親に持つことを明記
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    // public function category()
    // {
    //     return $this->belongsTo('App\Models\Category');
    // }

    // public function 
}
