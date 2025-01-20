<?php

namespace App\Models;


use CarbonCarbon;
use App\Models\User;
use App\Models\Offer;
use App\Models\Report;
use App\Models\Review;
use App\Models\Comment;
use App\Models\Contract;
use App\Models\Portfolio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'status',
        'description',
        'Exp_delivery_date',
        'delivery_date',
        'client_id',
        'freelancer_id',
        'section_id',
        'customer_attachments',
        'independent_attachments'
    ];

    protected $casts = [
        'exp_delivery_date' => 'datetime',
        'delivery_date' => 'datetime', // If needed for delivery_date
    ];
    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }
    public function freelancer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }
      public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function contract(): HasOne
    {
        return $this->hasOne(Contract::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }
    public function report(): HasOne
    {
        return $this->hasOne(Report::class);
    }

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }


}
