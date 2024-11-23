<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'reviewable_id',
        'reviewable_type',
        'comment',
        'rate',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function reviewable(): MorphTo
    {
        return $this->morphTo();
    }
}
