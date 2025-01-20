<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Report;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\ReportsExport;
use App\Exports\OneReportExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{

    /**
     * Summary of exportAllReports
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportAllReports()
    {
        return Excel::download(new ReportsExport, 'reports.xlsx');
    }
    /**
     * Summary of exportOneReport
     * @param mixed $reportId
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportOneReport($reportId)
    {
        $report = Report::findOrFail($reportId);
        return Excel::download(new OneReportExport($reportId), "reports_{$reportId}_{$report->project->name}.xlsx");
    }
    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $reports = Report::latest()->paginate(10);
        return view('admin.reports.index', compact('reports'));
    }
    /**
     * Summary of show
     * @param string $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(string$id)
    {
        $report = Report::findOrFail($id);
        $section = Section::findOrFail($report->project->section_id);
        $client = User::findOrFail($report->project->client_id);
        $freelancer = User::findOrFail($report->project->freelancer_id);
        return view('admin.reports.show',compact('report','section','client','freelancer'));
    }
    /**
     * Summary of destroy
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Report::destroy($id);
        return redirect()->back()->with('success','Report deleted successfully');
    }
    /**
     * Summary of forceDelete
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete($id){
        Report::withTrashed()->where('id',$id)->forceDelete();
        return redirect()->back()->with('success','Report deleted successfully');
    }
    /**
     * Summary of trashed
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function trashed()
    {
        $reports = Report::onlyTrashed()->paginate(10);
        return view('admin.reports.trashed', compact('reports'));
    }
    /**
     * Summary of restore
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $report = Report::withTrashed()->findOrFail($id);
        $report->restore();
        return redirect()->back()->with('success', 'Report restored successfully');
    }

}
