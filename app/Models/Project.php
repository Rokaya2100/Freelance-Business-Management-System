<?php

namespace App\Models;
use CarbonCarbon;
use App\Models\User;
use App\Models\Offer;
use App\Models\Report;
use App\Models\Review;
use App\Models\Contract;
use App\Models\Portfolio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphMany;
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
        'client_id',
        'freelancer_id',
        'section_id',
        'customer_attachments',
        'independent_attachments'
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    public function contracts(){
        return $this->hasOne(Contract::class);
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
    public function section()
    {
        return $this->belongsTo(Section::class);
    }



}
