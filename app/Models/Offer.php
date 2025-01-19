<?php

namespace App\Models;

use App\Models\User;
use App\Models\Project;
use App\Models\Contract;
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
    public function project(){
        return $this->belongsTo(Project::class);
    }

    // protected static function booted()
    // {
    //     static::updated(function ($offer) {
    //         // Check if the status changed to "accepted"
    //         if ($offer->isDirty('status') && $offer->status === 'accepted') {
    //             // Check if a contract already exists for the project
    //             if (!Contract::where('project_id', $offer->project_id)->exists()) {
    //                 // Create the contract
    //                 Contract::create([
    //                     'project_id' => $offer->project_id,
    //                     'freelancer_id' => $offer->user_id, // Freelancer's ID
    //                     'client_id' => $offer->project->user_id, // Client's ID
    //                     'price' => $offer->price,
    //                     'is_paid' => false,
    //                     'status' => 'in_progress',
    //                 ]);
    //             }
    //         }
    //     });
    // }

}
