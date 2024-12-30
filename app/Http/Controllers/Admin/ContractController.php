<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::select('contracts.id', 'contracts.created_at')
            ->join('projects', 'contracts.project_id', '=', 'projects.id')
            ->addSelect('projects.name as project_name')
            ->orderBy('contracts.created_at')
            ->paginate(10);
        return view('admin.contracts.index', compact('contracts'));
    }

    public function show(string $id)
    {
        $contract = Contract::findOrFail($id);
        $contract->load('project.users', 'freelancer');

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
}