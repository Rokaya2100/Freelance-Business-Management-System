<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Offer;
use App\Models\Report;
use App\Models\Project;
use App\Models\Section;
use App\Models\Contract;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:delete-project|projects-list', ['only' => ['index','show','trashed']]);
        $this->middleware('permission:delete-project', ['only' => ['destroy','forceDelete']]);
    }
    public function index()
    {
        $projects = Project::with(['client', 'freelancer','section'])->get();
        return view('admin.projects.index',  compact('projects'));
    }



    // public function create(){

    // $sections = Section::all();
    // return view('admin.projects.create',compact('sections'));
    // }

    // public function store(Request $request)
    // {

    // $project = new Project();
    // $project->name = $request->name;
    // $project->description = $request->description;
    // $project->exp_delivery_date = $request->exp_delivery_date;
    // $project->client_id = auth()->id();
    // $project->section_id = $request->section_id;
    // $project->save();

    // return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    // }


    // public function edit(Project $project)
    // {
    // if ($project->status !== 'pending' ) {
    // return redirect()->route('projects.index')->with('error', 'You can not modify the project because it is Under implementation.');
    // }
    // $expectedDeliveryDate = Carbon::parse($project->exp_delivery_date);
    // return view('projects.edit', compact('project','expectedDeliveryDate'));
    // }


    // public function update(Request $request, Project $project)
    // {
    // $project->name = $request->name;
    // $project->description = $request->description;
    // $project->exp_delivery_date = $request->exp_delivery_date;
    // $project->client_id = auth()->id();
    // $project->save();

    // return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    // }

    public function show($id)
    {
        $project = Project::with(['client', 'freelancer', 'offers'])->findOrFail($id);
        $reviews = $project->reviews()->get();
        $comments = $project->comments()->get();

        return view('admin.projects.show', compact('project','reviews','comments'));
    }

    public function destroy(Project $project)
{
    if ($project->status !=='pending' && $project->status !== 'completed') {
        return redirect()
            ->route('projects.index')
            ->with('error', 'The project is being prepared, you can not delete it ');
    }
    if($project->contract()->exists()||$project->report()->exists()||$project->offers()->exists()){
    $project->offers()?->delete();
    $project->contract()?->delete();
    $project->report()?->delete();
    }
    $project->delete();
    return redirect()
        ->route('projects.index')
        ->with('success', 'Project deleted successfully');
}


    public function trashed()
    {
    $projects = Project::onlyTrashed()->paginate(10);
    return view('admin.projects.trashed', compact('projects'));
    }

    public function restore($id)
    {
        $project = Project::withTrashed()->findOrFail($id);
        $contract = Contract::withTrashed()->where('project_id','=',$id);
        $report = Report::withTrashed()->where('project_id','=',$id);
        $offer = Offer::withTrashed()->where('project_id','=',$id);
        $project->restore();
        $contract->restore();
        $report->restore();
        $offer->restore();
        return redirect()->route('projects.trashed')->with('success', 'Project restored successfully.');

}
    public function forceDelete($id){
        $project=Project::withTrashed()->where('id',$id)->forceDelete();
        if($project->contract()->exists()||$project->report()->exists()||$project->offers()->exists()){
            $project->offers()?->delete();
            $project->contract()?->delete();
            $project->report()?->delete();
            }
        return redirect()->back()->with('success','Project deleted successfully');
    }
}
