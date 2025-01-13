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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }
      public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function contract()
    {
        return $this->hasOne(Contract::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
    public function reporte()
    {
        return $this->hasOne(Report::class);
    }





}
