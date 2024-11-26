<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'project_id',
        'description',
        'file_path'
    ];
   public function project(){
    return $this->belongsTo(Project::class);
   }
}
