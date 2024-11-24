<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Http\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    public function index()
    {
    }
    public function store(ProjectRequest $request)
    {
        $project = new Project();
        $project->name = $request->name;
        $project->status = $request->status;
        $project->description = $request->description;
        $project->exp_delivery_date = $request->exp_delivery_date;
        $project->delivery_date = $request->delivery_date;
        $project->portfolio_id = $request->portfolio_id;
        $project->section_id = $request->section_id;
        $project->user_id =  $request->user_id;
        $project->save();
        return $this->successResponse($project,"project created successfully",200);
    }
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return $this->successResponse(new ProjectResource($project),"project returned successfully");
    }
    public function update(ProjectRequest $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->name = $request->name;
        $project->status = $request->status;
        $project->description = $request->description;
        $project->exp_delivery_date = $request->exp_delivery_date;
        $project->delivery_date = $request->delivery_date;
        $project->portfolio_id = $request->portfolio_id;
        $project->section_id = $request->section_id;
        $project->user_id =  $request->user_id;
        $project->save();
        return $this->successResponse($project,"project updated successfully",200);
    }

    public function destroy($id)
    {
        $project=Project::findOrFail($id);
        if($project->status == 'pending'){
            $project->delete();
            return $this->successResponse(null,"project deleted successfully",200);
        }
        return $this->errorResponse();
    }
}
