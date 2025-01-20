<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Review;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Resources\ReviewResource;
use Illuminate\Database\Eloquent\Relations\Relation;

class ReviewController extends Controller
{
    use ApiResponseTrait ;

    /**
     * Summary of index
     * @param mixed $project_id
     * @return JsonResponse|mixed
     */
    public function index($project_id){
        $project = Project::find($project_id);
        $reviews = $project->reviews;
        return $this->RevResponse( $reviews, 'You have already reviewed this project', 200);
    }

    /**
     * Summary of showReview
     * @param mixed $project_id
     * @param mixed $review_id
     * @return JsonResponse|mixed
     */
    public function showReview($project_id, $review_id)
    {
        $project = Project::find($project_id);

        if (!$project) {
            return $this->RevResponse(null, 'Project not found', 404);
        }

        $review = $project->reviews()->find($review_id);

        if (!$review) {
            return $this->RevResponse(null, 'Review not found', 404);
        }

        return $this->RevResponse($review, 'Review retrieved successfully', 200);
    }
    /**
     * Summary of projectRate
     * @param \App\Http\Requests\ReviewRequest $request
     * @param \App\Models\Project $project
     * @return JsonResponse|mixed
     */
    public function projectRate(ReviewRequest $request, Project $project)
    {
        $client = Auth::user();
        $validated = $request->validated();
        if ($project->status !== 'completed') {
            return $this->RevResponse(null, 'You cannot rate this project because it is not completed yet.', 400);
        }
        $existingReview = $project->reviews()->where('user_id', $client->id)->first();
        if ($existingReview) {
            return $this->RevResponse(null, 'You have already reviewed this project', 400);
        }

        $review = $project->reviews()->create([
            'user_id' => $client->id,
            'rate' => $validated['rate'],

        ]);

        $data = new ReviewResource($review);
        return $this->RevResponse($data, 'Project rated successfully', 201);
    }


        /**
         * Summary of freelancerRate
         * @param \App\Http\Requests\ReviewRequest $request
         * @param \App\Models\User $user
         * @return JsonResponse|mixed
         */
        public function freelancerRate(ReviewRequest $request, User $user)
        {

            $client = Auth::user();
            $validated = $request->validated();
            $existingReview = $client->reviews()->where('user_id', $user->id)->first();
            if ($existingReview) {
                return $this->RevResponse(null, 'You have already reviewed this freelancer', 400);
            }


            $review = $user->reviews()->create([
                'user_id' => $client->id,
                'rate' => $validated['rate'],
            ]);

            $data = new ReviewResource($review);
            return $this->RevResponse($data, 'Freelancer rated successfully', 201);

        }

}





