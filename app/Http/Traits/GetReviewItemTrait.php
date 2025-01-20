<?php

namespace App\Http\Traits;

use App\Http\Resources\UserResource;
use App\Http\Resources\ProjectResource;
use App\Models\User;
use App\Models\Project;

trait GetReviewItemTrait
{
    /**
     * Summary of getItem
     * @param mixed $reviewableType
     * @param mixed $reviewableId
     * @return array|string
     */
    public function getItem($reviewableType, $reviewableId)
    {

        switch ($reviewableType) {
            case 'App\Models\Project':
                $project = Project::findOrFail($reviewableId);
                return ['item_type' => 'project',new ProjectResource($project)];
                break;
            case 'App\Models\User':
                $user= User::findOrFail($reviewableId);
                return ['item_type' => 'user',new UserResource($user)];
                break;
            default:
                return 'Not Found!';
                break;
        }
    }
}
