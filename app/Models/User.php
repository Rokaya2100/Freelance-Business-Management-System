<?php

namespace App\Models;

use App\Models\Offer;
use App\Models\Review;
use App\Models\Comment;
use App\Models\Contract;
use App\Models\Portfolio;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'country',
        'role',
        'image',
        'last_seen',
        'password',
    ];


    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class ,'reviewable');
    }

    public function comments():HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function projects(): HasMany {
        return $this->hasMany(Project::class,'freelancer_id','id');
    }

    public function contracts(): HasMany{
        return $this->hasMany(Contract::class,'freelancer_id','id');
    }
    public function portfolio(): HasOne{
        return $this->hasOne(Portfolio::class);
    }
    public function offers():HasMany{
        return $this->hanMany(Offer::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
