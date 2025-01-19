<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\StorePortfolioRequest;

class PortfolioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-portfolio|edit-portfolio', ['only' => ['index','show']]);
        $this->middleware('permission:create-portfolio', ['only' => ['fillPortfolio']]);
        $this->middleware('permission:edit-portfolio', ['only' => ['updatePortfolio']]);
        $this->middleware('permission:add-project-to-portfolio', ['only' => ['addProjectToPortfolio']]);
        $this->middleware('permission:delete-project-from-portfolio', ['only' => ['removeProjectFromPortfolio']]);
    }
    /**
     * Fill in the freelancer's portfolio (Skills & Description).
     */
    public function fillPortfolio(Request $request)
    {
        $user = auth()->user();

        // Ensure the user is a freelancer
        if ($user->role !== 'freelancer') {
            return response()->json(['error' => 'Only freelancers can fill their portfolio'], 403);
        }

        // Validate the request
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'skills' => 'required|string|max:255',
        ]);

        // Check if the freelancer already has a portfolio
        $portfolio = $user->portfolio;

        if ($portfolio->description || $portfolio->skills) {
            return response()->json(['error' => 'Portfolio already filled. Use the update method to change details.'], 400);
        }

        // Fill the portfolio fields
        $portfolio->description = $validated['description'];
        $portfolio->skills = $validated['skills'];
        $portfolio->save();

        return response()->json([
            'message' => 'Portfolio filled successfully.',
            'portfolio' => $portfolio
        ]);
    }

    /**
     * Update the freelancer's portfolio (Skills & Description).
     */
    public function updatePortfolio(StorePortfolioRequest $request)
    {
        $user = auth()->user();

        // Ensure the user is a freelancer
        if ($user->role !== 'freelancer') {
            return response()->json(['error' => 'Only freelancers can update their portfolio'], 403);
        }

        // Validate the request
        $validated = $request->validate([
            // 'description' => 'nullable|string|max:255',
            // 'skills' => 'nullable|string|max:255',
        ]);

        // Check if the freelancer already has a portfolio
        $portfolio = $user->portfolio;

        if (!$portfolio) {
            return response()->json(['error' => 'Portfolio not found'], 404);
        }

        // Update the portfolio fields if provided
        if ($validated['description']) {
            $portfolio->description = $validated['description'];
        }

        if ($validated['skills']) {
            $portfolio->skills = $validated['skills'];
        }

        $portfolio->save();

        return response()->json([
            'message' => 'Portfolio updated successfully.',
            'portfolio' => $portfolio
        ]);
    }

    public function addProjectToPortfolio(Request $request)
    {
        $user = auth()->user();

        // Ensure the user is a freelancer
        if ($user->role !== 'freelancer') {
            return response()->json(['error' => 'Only freelancers can add projects to their portfolio'], 403);
        }

        // Validate the request
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
        ]);

        $project = Project::where('id', $validated['project_id'])
            ->where('freelancer_id', $user->id) // Ensure the project belongs to the freelancer
            ->first();

        if (!$project) {
            return response()->json(['error' => 'Project not found or unauthorized'], 403);
        }

        // Retrieve the freelancer's portfolio
        $portfolio = $user->portfolio;

        // Added: Prevent duplicate assignments
        if ($project->portfolio_id === $portfolio->id) {
            return response()->json(['error' => 'Project is already in your portfolio.'], 422);
        }

        // Attach the project to the freelancer's portfolio
        $project->portfolio_id = $portfolio->id;
        $project->save();

        return response()->json([
            'message' => 'Project added to portfolio successfully.',
            // Added: Include portfolio projects in the response
            'portfolio' => $portfolio->load('projects'),
        ]);
    }

    public function removeProjectFromPortfolio(Request $request)
    {
        $user = auth()->user();

        // Ensure the user is a freelancer
        if ($user->role !== 'freelancer') {
            return response()->json(['error' => 'Only freelancers can remove projects from their portfolio'], 403);
        }

        // Validate the request
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
        ]);

        $portfolio = $user->portfolio;

        // Check if the user has a portfolio (optional, for extra safety)
        if (!$portfolio) {
            return response()->json(['error' => 'You do not have a portfolio.'], 404);
        }

        $project = Project::where('id', $validated['project_id'])
            ->where('portfolio_id', $portfolio->id) // Ensure the project belongs to the user's portfolio
            ->first();

        if (!$project) {
            return response()->json(['error' => 'Project not found in your portfolio'], 403);
        }

        // Remove the project from the portfolio
        $project->portfolio_id = null;
        $project->save();

        return response()->json([
            'message' => 'Project removed from portfolio successfully',
            // Optional: Include updated portfolio projects in the response
            'portfolio' => $portfolio->load('projects'),
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
}
