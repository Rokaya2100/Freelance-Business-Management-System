<?php

namespace App\Models;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'project_id',
        'user_id',
        'status',
        'description',
        'price',
        'period'
    ];
    public function users(){
        return $this->belongsTo(User::class);
    }
    public function projects(){
        return $this->belongsTo(Project::class);
    }
}
