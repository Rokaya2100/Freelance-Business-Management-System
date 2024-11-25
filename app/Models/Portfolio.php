<?php

namespace App\Models;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Portfolio extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'description',
        'skills'
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
    public function projects(){
        return $this->hasMany(Project::class);
    }
}
