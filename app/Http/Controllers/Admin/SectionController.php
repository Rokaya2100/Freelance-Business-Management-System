<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Models\Section;

class SectionController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $sections = Section::latest()->paginate(20);
        return view('admin.sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * Summary of create
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Summary of store
     * @param \App\Http\Requests\SectionRequest $request
     * @return \Illuminate\Http\RedirectResponse
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
    /**
     * Summary of show
     * @param string $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(string $id)
    {
        $section = Section::findOrFail($id);
        return view('admin.sections.show', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Summary of edit
     * @param string $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(string $id)
    {
        $section = Section::findOrFail($id);
        return view('admin.sections.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Summary of update
     * @param \App\Http\Requests\SectionRequest $request
     * @param \App\Models\Section $section
     * @return \Illuminate\Http\RedirectResponse
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
    /**
     * Summary of destroy
     * @param \App\Models\Section $section
     * @return \Illuminate\Http\RedirectResponse
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
    /**
     * Summary of restore
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $section = Section::withTrashed()->findOrFail($id);
        $section->restore();

        return redirect()
            ->route('sections.trashed')
            ->with('success', 'Section restored successfully');
    }
    /**
     * Summary of trashed
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function trashed()
    {
        $sections = Section::onlyTrashed()->paginate(10);
        return view('admin.sections.trashed', compact('sections'));
    }
    /**
     * Summary of forceDelete
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete($id){
        Section::withTrashed()->where('id',$id)->forceDelete();
        return redirect()->back()->with('success','Section deleted successfully');
    }
}
