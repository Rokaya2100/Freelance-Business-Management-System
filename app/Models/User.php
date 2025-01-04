<?php

namespace App\Models;

use App\Models\Offer;
use App\Models\Review;
use App\Models\Contract;
use App\Models\Portfolio;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail,CanResetPassword
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



    public function project(){
        return $this->hasMany(Project::class);
    }
    public function contracts(){
        return $this->hasMany(Contract::class);
    }
    public function portfolio(){
        return $this->hasOne(Portfolio::class);
    }
    public function offers(){
        return $this->hanMany(Offer::class);
    }
    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class ,'reviewable');
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
