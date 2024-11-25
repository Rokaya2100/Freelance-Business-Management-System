<?php

namespace App\Models;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contract extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'project_id',
        'status',
        'end_date',
        'price',
        'is_paid'
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
    public function projects(){
        return $this->belongsTo(Project::class);
    }
}
