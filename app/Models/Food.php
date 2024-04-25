<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    protected $fillable = [
        'id',
        'info',
        'image',
        'category_id',
        'limit_date',
        'alart',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDisplayInfoAttribute(): string
    {
        return $this->info . '最高';
    }
}
