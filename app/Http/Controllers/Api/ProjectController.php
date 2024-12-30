<?php
namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Http\Controllers\Api\AuthController;

class ProjectController extends Controller
{
    use jsonTrait;
    public function index()
    {
    }
    public function store(ProjectRequest $request)
    {
        $path_independent_attachments = null;
        if(request()->hasFile('independent_attachments')){
            $file=request()->file('independent_attachments');
            $path_independent_attachments=uploadImage($file,'independent_attachments','public');
        }
        $path_customer_attachments = null;
        if(request()->hasFile('customer_attachments')){
            $file=request()->file('customer_attachments');
            $path_customer_attachments=uploadImage($file,'customer_attachments','public');
        }
        $project = new Project();
        $project->name = $request->name;
        $project->status = $request->status;
        $project->description = $request->description;
        $project->exp_delivery_date = $request->exp_delivery_date;
        $project->delivery_date = $request->delivery_date;
        $project->portfolio_id = $request->portfolio_id;
        $project->section_id = $request->section_id;
        $project->user_id =  Auth::id();
        $project->independent_attachments =   $path_independent_attachments;
        $project->customer_attachments =   $path_customer_attachments ;
        $project->save();
        return $this->jsonResponse(201,"project created successfully",new ProjectResource($project));

    }
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return $this->jsonResponse(200,"project returned successfully",new ProjectResource($project));
    }
    public function update(ProjectRequest $request, $id)
    {
        $path_independent_attachments = null;
        if(request()->hasFile('independent_attachments')){
            $file=request()->file('independent_attachments');
            $path_independent_attachments=uploadImage($file,'independent_attachments','public');
        }
        $path_customer_attachments = null;
        if(request()->hasFile('customer_attachments')){
            $file=request()->file('customer_attachments');
            $path_customer_attachments=uploadImage($file,'customer_attachments','public');
        }
        $project = Project::findOrFail($id);
        $project->name = $request->name;
        $project->status = $request->status;
        $project->description = $request->description;
        $project->exp_delivery_date = $request->exp_delivery_date;
        $project->delivery_date = $request->delivery_date;
        $project->portfolio_id = $request->portfolio_id;
        $project->section_id = $request->section_id;
        $project->user_id =  Auth::id();
        $project->independent_attachments =   $path_independent_attachments;
        $project->customer_attachments =   $path_customer_attachments ;
        $project->save();
        return $this->jsonResponse(200,'project updated successfully',new ProjectResource($project));
    }

    public function destroy($id)
    {
        $project=Project::findOrFail($id);
        $state =$project->status;
        if($state == 'pending'){
            $del=$project->delete();
            return $this->jsonResponse(204,'project deleted successfully',$del);
        }
        return $this->errorResponse(404,"you  can't delete,You can only delete if the project is pending and this project is $state");
    }
    public function forceDelete($id){
        $project=Project::findOrFail($id);
        $state =$project->status;
        if($state == 'pending'){
        Project::withTrashed()->where('id',$id)->forceDelete();
        return $this->jsonResponse(204,'project deleted successfully');
        }
        return $this->errorResponse(404,"you  can't delete,You can only delete if the project is pending and this project is $state");

    }
}
