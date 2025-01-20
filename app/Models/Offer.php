<?php

namespace App\Models;

use App\Models\User;
use App\Models\Project;
use App\Models\Contract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
  
    public function users(): BelongsTo{
        return $this->belongsTo(User::class,'user_id');
    }
    public function project(): BelongsTo{
        return $this->belongsTo(Project::class);
    }

   

}
