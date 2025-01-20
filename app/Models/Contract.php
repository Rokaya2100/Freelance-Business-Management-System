<?php

namespace App\Models;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class,);
    }

    public function freelancer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }
    

}
