<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Models\Section;

class SectionController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('permission:create-section|edit-section|delete-section|sections-list', ['only' => ['index','show','trashed']]);
    //     $this->middleware('permission:create-section', ['only' => ['create','store','restore']]);
    //     $this->middleware('permission:delete-section', ['only' => ['destroy','forceDelete']]);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::latest()->paginate(20);
        return view('admin.sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionRequest $request)
    {
        Section::create($request->validated());

        return redirect()
            ->route('sections.index')
            ->with('success', 'Section created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $section = Section::findOrFail($id);
        return view('admin.sections.show', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $section = Section::findOrFail($id);
        return view('admin.sections.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionRequest $request, Section $section)
    {
        $section->update($request->validated());
        return redirect()
            ->route('sections.index')
            ->with('success', 'Section updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        if ($section->projects()->exists()) {
            return redirect()
                ->route('sections.index')
                ->with('error', 'Cannot delete section that has associated projects');
        }

        $section->delete();

        return redirect()
            ->route('sections.index')
            ->with('success', 'Section deleted successfully');
    }

    public function restore($id)
    {
        $section = Section::withTrashed()->findOrFail($id);
        $section->restore();

        return redirect()
            ->route('sections.trashed')
            ->with('success', 'Section restored successfully');
    }

    public function trashed()
    {
        $sections = Section::onlyTrashed()->paginate(10);
        return view('admin.sections.trashed', compact('sections'));
    }
    public function forceDelete($id){
        Section::withTrashed()->where('id',$id)->forceDelete();
        return redirect()->back()->with('success','Section deleted successfully');
    }
}
