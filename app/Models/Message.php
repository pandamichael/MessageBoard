<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    // 指定可以批量填充（mass assignable）的欄位
    protected $fillable = ['content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
