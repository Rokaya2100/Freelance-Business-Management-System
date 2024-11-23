<?php

namespace App\Models;

use App\Models\User;
use App\Models\Offer;
use App\Models\Report;
use App\Models\Review;
use App\Models\Contract;
use App\Models\Portfolio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'status',
        'description',
        'Exp_delivery_date',
        'delivery_date',
        'portfolio_id',
        'user_id',
        'section_id'
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
    public function contracts(){
        return $this->hasOne(Contract::class);
    }
    public function portfolios(){
        return $this->belongsTo(Portfolio::class);
    }
    public function offers(){
        return $this->hasMany(Offer::class);
    }
    public function reporte(){
        return $this->hasOne(Report::class);
    }
    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class ,'reviewable');
    }

}
