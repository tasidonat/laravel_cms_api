<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const STATUS = [
        'approved' => 100,
        'draft' => 1
    ];

    public function category()
    {
        return $this->belongsTo(Category::class)->first();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->first();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->get();
    }
}
