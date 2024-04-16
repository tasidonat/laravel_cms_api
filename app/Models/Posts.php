<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const STATUS = [
        'approved' => 100,
        'draft' => 1
    ];

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments():HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
