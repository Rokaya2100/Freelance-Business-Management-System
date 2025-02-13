<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Offer;
use App\Models\Project;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:show-contract|contracts-list', ['only' => ['index','show']]);
        $this->middleware('permission:edit-contract', ['only' => ['freelancerViewAndUpdateContract']]);

    }
    /**
     * Display a listing of the resource.
     */
    /**
     * Summary of index
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $user = auth()->user();

        // Determine if the user is a client or a freelancer
        if ($user->role !== 'client' && $user->role !== 'freelancer') {
            return response()->json([
                'error' => 'Only clients or freelancers can view their contracts.',
            ], 403);
        }

        // Fetch contracts based on the user's role
        if ($user->role === 'client') {
            $contracts = Contract::where('client_id', $user->id)
                ->with(['project', 'freelancer']) // Include related data
                ->latest()
                ->paginate(10);
        } elseif ($user->role === 'freelancer') {
            $contracts = Contract::where('freelancer_id', $user->id)
                ->with(['project', 'client']) // Include related data
                ->latest()
                ->paginate(10);
        }

        if ($contracts->isEmpty()) {
            return response()->json([
                'message' => 'No contracts found.',
            ], 200);
        }

        return response()->json($contracts);
    }

    /**
     * Display the specified resource.
     */
    /**
     * Summary of show
     * @param string $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $contract = Contract::with(['client', 'freelancer'])->findOrFail($id);

        // Authorization: Only the client or freelancer can view this contract
        if (!in_array(auth()->id(), [$contract->freelancer_id, $contract->client_id])) {
            return response()->json(['error' => 'Unauthorized access to this contract'], 403);
        }

        return response()->json([
            'contract' => $contract,
            'project' => [
            'id' => $contract->project->id,
            'name' => $contract->project->name,
            'description' => $contract->project->description,
            'exp_delivery_date' => $contract->project->exp_delivery_date,
            'delivery_date' => $contract->project->delivery_date,
            'status' => $contract->project->status,
            'client' => [
                'id' => $contract->project->user->id,
                'name' => $contract->project->user->name,
            ],
            'section_name' => $contract->project->section->name,
        ],
            'freelancer' => [
                'id' => $contract->freelancer->id,
                'name' => $contract->freelancer->name,
            ],
        ]);
    }
    /**
     * Summary of freelancerViewAndUpdateContract
     * @param \Illuminate\Http\Request $request
     * @param mixed $offerId
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function freelancerViewAndUpdateContract(Request $request, $offerId)
    {
       
        $offer=Offer::findOrfail($offerId);
        $contract = $offer->project->contract;
        if ($contract->freelancer_id !== auth()->user()->id){
            return response()->json(['error' => 'You are not authorized to update this contract'], 403);
        }
        if (!$offer || $offer->status !== 'accepted') {
            return response()->json(['error' => 'No accepted offer found or unauthorized'], 403);
        }

        if (!$contract) {
            return response()->json(['error' => 'No contract found for this offer'], 404);
        }

        // Step 2: Allow updating `is_paid` only if the project is completed
        if ($request->has('is_paid')) {
            if ($offer->project->status !== 'completed') {
                return response()->json(['error' => 'Payment update is only allowed for completed projects'], 422);
            }

            // Update `is_paid` and change status to 'expired' if `is_paid` is true
            $contract->is_paid = $request->is_paid;
            if ($request->is_paid == true) {
                $contract->status = 'expired';
            }
            $contract->save();
        }

        // Step 3: Return the contract
        return response()->json([
            'contract' => $contract,
            'project' => [
                'id' => $offer->project->id,
                'name' => $offer->project->name,
                'status' => $offer->project->status,
            ],
        ]);
    }


}
