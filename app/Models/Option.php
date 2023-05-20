<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $table = 'options';

    protected $fillable = [
        'id',
        'line_user_id',
        'enable',
        'user_id',
        'line_user_name',
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function toggleEnable()
    {
        $this->enable = !$this->enable;
        $this->save();
    }
}
