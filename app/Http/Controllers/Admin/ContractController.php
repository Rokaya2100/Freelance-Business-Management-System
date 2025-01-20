<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;

class ContractController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('permission:delete-contract|contracts-list', ['only' => ['index','show','trashed']]);
    //     $this->middleware('permission:restore-contract', ['only' => ['restore']]);
    //     $this->middleware('permission:delete-contract', ['only' => ['destroy','forceDelete']]);
    // }
    public function index()
    {
        $contracts = Contract::latest()->paginate(20);
        return view('admin.contracts.index', compact('contracts'));
    }


    public function show(string $id)
    {
        $contract = Contract::with(['client', 'freelancer', 'project'])->findOrFail($id);

        return view('admin.contracts.show', compact('contract'));
    }

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

    public function restore($id)
    {
        $contract = Contract::withTrashed()->findOrFail($id);
        $contract->restore();

        return redirect()
            ->route('contracts.trashed')
            ->with('success', 'contract restored successfully');
    }


    public function trashed()
    {
        $contracts = Contract::onlyTrashed()->paginate(10);
        return view('admin.contracts.trashed', compact('contracts'));
    }

    public function forceDelete($id){
        Contract::withTrashed()->where('id',$id)->forceDelete();
        return redirect()->back()->with('success','Contract deleted successfully');
    }
}
