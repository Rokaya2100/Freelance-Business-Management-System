<?php

namespace App\Listeners;

use App\Events\ProjectCompleted;
use App\Models\Report;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateProjectReport
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProjectCompleted $event): void
    {
        $project = $event->project;
        Report::create([
            'project_id'  => $project->id,
            'description' =>  $project->name,
            'file_path' => $project->status
        ]);
    }
}
