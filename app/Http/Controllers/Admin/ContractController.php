<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;

class ContractController extends Controller
{
    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $contracts = Contract::latest()->paginate(20);
        return view('admin.contracts.index', compact('contracts'));
    }

    /**
     * Summary of show
     * @param string $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(string $id)
    {
        $contract = Contract::with(['client', 'freelancer', 'project'])->findOrFail($id);

        return view('admin.contracts.show', compact('contract'));
    }
    /**
     * Summary of destroy
     * @param \App\Models\Contract $contract
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Contract $contract)
    {
        if ($contract->status !== 'expired') {
            return redirect()
                ->route('contracts.index')
                ->with('error', 'Only expired contracts can be deleted');
        }

        $contract->delete();
        return redirect()
            ->route('contracts.index')
            ->with('success', 'Contract deleted successfully');
    }
    /**
     * Summary of restore
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $contract = Contract::withTrashed()->findOrFail($id);
        $contract->restore();

        return redirect()
            ->route('contracts.trashed')
            ->with('success', 'contract restored successfully');
    }

    /**
     * Summary of trashed
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function trashed()
    {
        $contracts = Contract::onlyTrashed()->paginate(10);
        return view('admin.contracts.trashed', compact('contracts'));
    }
    /**
     * Summary of forceDelete
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete($id){
        Contract::withTrashed()->where('id',$id)->forceDelete();
        return redirect()->back()->with('success','Contract deleted successfully');
    }
}
