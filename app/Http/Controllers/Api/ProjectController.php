<?php
namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Events\ProjectCompleted;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\OfferCollection;
use App\Http\Resources\ProjectResource;
use App\Http\Controllers\Api\AuthController;

class ProjectController extends Controller
{
    use jsonTrait;
    public function index()
    {
        $projects = Project::paginate(5);
        if($projects->isEmpty()){
            return $this->jsonResponse(404, 'No projects Found', null);
        }
        return $this->jsonResponse(200, 'All projects', new OfferCollection($projects));
 
    }
    public function store(ProjectRequest $request)
    {
        $user = auth()->user();
        $path_independent_attachments = null;
        if(request()->hasFile('independent_attachments')){
            $file=request()->file('independent_attachments');
            $path_independent_attachments=uploadImage($file,'independent_attachments','public');
        }

        $project = new Project();
        $project->name = $request->name;
        $project->description = $request->description;
        $project->independent_attachments = $request->independent_attachments;
        $project->exp_delivery_date = $request->exp_delivery_date;
        $project->client_id = $user->id;
        $project->section_id = $request->section_id;
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

        $project = Project::findOrFail($id);
        $state =$project->status;
        if($state == 'pending'){
        $project->update([
            'name'        => $request->name,
            'description' => $request->description,
            'section_id'  => $request->section_id,
            'exp_delivery_date' => $request->exp_delivery_date
        ]);
        return $this->jsonResponse(200,'project updated successfully',new ProjectResource($project));
        }
        return $this->errorResponse(404,"you  can't update,You can only update if the project is pending and this project is $state");
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
    public function updateProjectFromFreelancer(Request $request, $id)
    {
        $path_customer_attachments = null;
        if(request()->hasFile('customer_attachments')){
            $file=request()->file('customer_attachments');
            $path_customer_attachments=uploadImage($file,'customer_attachments','public');
        }
        $project = Project::findOrFail($id);
        $project->status = $request->status;
        if($request->status == 'completed'){
            $project->delivery_date = now();
            event(new ProjectCompleted($project));
        }
        $project->customer_attachments =   $path_customer_attachments ;
        $project->save();
        return $this->jsonResponse(204,'update project from freelancer successfully');

    }
}
