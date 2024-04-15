<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const STATUS = [
        'approved' => 100,
        'denied' => 50,
        'pendding' => 0
    ];

    public function post()
    {
        return $this->belongsTo(Posts::class)->first();
    }
}
