<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PortfolioResource;
use App\Http\Requests\StorePortfolioRequest;
use App\Http\Resources\ProjectWithCommRateCollection;
use App\Http\Resources\ProjectWithCommRateResource;


class PortfolioController extends Controller
{

    /**
     * Summary of updatePortfolio
     * @param \App\Http\Requests\StorePortfolioRequest $request
     * @param mixed $id
     * @return mixed
     */
    public function updatePortfolio(StorePortfolioRequest $request,$id)
    {
        $user = auth()->user();


        $portfolio=Portfolio::findOrfail($id);
        if ($portfolio->user_id !== auth()->user()->id){
            return $this->jsonResponse(403, 'You are not authorized to update this portfolio',null);
        }
        $portfolio->update([
            'description' => $request->description,
            'skills'      => $request->skills,
        ]);
        return response()->json([
            'message' => 'Portfolio updated successfully.',
            'portfolio' => $portfolio,
        ]);
    }
    /**
     * Summary of addProjectToPortfolio
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
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
            'message' => 'Project added to portfolio successfully.']);
    }
    /**
     * Summary of removeProjectFromPortfolio
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
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
    /**
     * Summary of index
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function index()
    {

        // Retrieve all portfolios, including freelancer details (name), description, and skills
        $portfolios = Portfolio::with('user:id,name') // Load user (freelancer) and projects
            ->get(['id', 'description', 'skills']); // Retrieve specific fields for portfolios

        // Return the portfolios along with their associated data
        return response()->json([
            'portfolios' => $portfolios,
        ]);
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
        // Retrieve the portfolio with the freelancer's name, description, skills, and the projects associated
        $portfolio = Portfolio::with('user:id,name', 'projects:id,name') // Load user and projects
            ->where('id', $id) //  Filter the portfolio by the provided $id
            ->firstOrFail(); // If portfolio doesn't exist, it will throw a 404

        // Return the portfolio with the freelancer details and projects
        return response()->json([
            'portfolio' => $portfolio,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */

     //get all projects with comments and reviews
    /**
     * Summary of getFullPortfolio
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getFullPortfolio($id)
    {
        $portfolio = Portfolio::where('id', $id)->firstOrFail();
        $user_id = $portfolio->user_id;
        $projects = Project::where('freelancer_id', $user_id)->with(['reviews','comments'])->get();

        return response()->json([
           new PortfolioResource($portfolio),
           new ProjectWithCommRateCollection($projects),

        ]);
    }

}
