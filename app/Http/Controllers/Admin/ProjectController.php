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
    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $projects = Project::with(['client', 'freelancer','section'])->get();
        return view('admin.projects.index',  compact('projects'));
    }
    /**
     * Summary of show
     * @param mixed $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $project = Project::with(['client', 'freelancer', 'offers'])->findOrFail($id);
        $reviews = $project->reviews()->get();
        $comments = $project->comments()->get();

        return view('admin.projects.show', compact('project','reviews','comments'));
    }
    /**
     * Summary of destroy
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Summary of trashed
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function trashed()
    {
    $projects = Project::onlyTrashed()->paginate(10);
    return view('admin.projects.trashed', compact('projects'));
    }
    /**
     * Summary of restore
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
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
    /**
     * Summary of forceDelete
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
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
