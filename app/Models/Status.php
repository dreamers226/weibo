<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['content'];
    
    // 模型关联一条微博动态属于一个用户
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
