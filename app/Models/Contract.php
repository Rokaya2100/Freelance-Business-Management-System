<?php

namespace App\Models;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'project_id',
        'price',
        'is_paid',
        'freelancer_id',
        'client_id',
    ];

    // public function users(){
    //     return $this->belongsTo(User::class);
    // }
    public function project()
    {
        return $this->belongsTo(Project::class,);
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
    

}
