<?php

namespace App\Http\Controllers\Api;

use App\Models\Offer;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Http\Requests\OfferRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;

class OfferController extends Controller
{
    use jsonTrait;

    public function index(){

        $offers = Offer::paginate(5);
        if($offers->isEmpty()){
            return $this->jsonResponse(404, 'No Offers Found', null);
        }
        return $this->jsonResponse(200, 'All Offers', OfferResource::collection($offers));
    }

    public function getProjectOffers(Project $project)//to get all offers that related to this project
    {
        $projectOffers = $project->offers()->paginate(5);
        return $this->jsonResponse(200, 'All Offers that Related to this Project', OfferResource::collection($projectOffers));
    }

    public function show(Offer $offer){
        if (!$offer) {
            return $this->jsonResponse(404, 'Offer Not Found', null);
        }
        return $this->jsonResponse(200, 'Offer Details', new OfferResource($offer));
    }

    public function store(OfferRequest $request, Project $project){

        $project_id=$project->id;

        $user = auth()->user();
        if (!$user) {
            return $this->jsonResponse(401, 'Unauthorized', null);
        }

        if (!$project) {
            return $this->jsonResponse(404, 'Project Not Found', null);
        }
        $offer = Offer::create([
            'price' => $request->price,
            'description' => $request->description,
            'period' => $request->period,
            'user_id' =>$user->id,
            'project_id' => $project_id,
            'status' => 'pending'
        ]);
        return $this->jsonResponse(201, 'Offer Created Successfully');
    }

    public function update(OfferRequest $request, Offer $offer)//update offer details by freelanser
    {
        $offer->update([
            'price' => $request->price,
            'description' => $request->description,
            'period' => $request->period,
        ]);
        return $this->jsonResponse(201, 'Offer Updated Successfully', );
    }

    public function updateStatus(OfferRequest $request, Offer $offer)//to update status by client
    {
        $offer->update([
            'status' => $request->status,
        ]);
        return $this->jsonResponse(200, 'Offer Status Updated Successfully', );
    }


    public function restore($id){
        $offer = Offer::withTrashed()->find($id);
        if (!$offer) {
            return $this->jsonResponse(404, 'Offer Not Found', null);
        }

        $offer->restore();
        return $this->jsonResponse(200, 'Offer Restored Successfully', new OfferResource($offer));
    }
    public function forceDelete($id){
        $offer = Offer::findOrFail($id);
        $offer->forceDelete();
        return $this->jsonResponse(204, 'Offer Deleted Permanently',);
    }

    public function destroy(Offer $offer)//can delete offer that its status is not accepted
    {

        if ($offer && $offer->status !== 'accepted') {
            $offer->delete();
        }else{
            return $this->jsonResponse(404, 'Offer Not Found', null);
        }
        return $this->jsonResponse(204, 'Offer Deleted', null);
    }
}
