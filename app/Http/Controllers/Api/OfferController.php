<?php

namespace App\Http\Controllers\Api;

use App\Models\Offer;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Events\OfferAccepted;
use App\Http\Traits\jsonTrait;
use App\Http\Requests\OfferRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use App\Http\Resources\OfferCollection;

class OfferController extends Controller
{
    use jsonTrait;


    //freelancer+client
    /**
     * Summary of getProjectOffers
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProjectOffers(Project $project)//to get all offers that related to this project
    {
        if($project->offers->isEmpty()){
            return $this->jsonResponse(404, 'No Offers Found', null);
        }
        $projectOffers = $project->offers()->paginate(3);
        return $this->jsonResponse(200, 'All Offers that Related to this Project', new OfferCollection($projectOffers));
    }
    /**
     * Summary of show
     * @param \App\Models\Offer $offer
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Offer $offer){
        if (!$offer) {
            return $this->jsonResponse(404, 'Offer Not Found', null);
        }
        return $this->jsonResponse(200, 'Offer Details', new OfferResource($offer));
    }
    //freelancer
    public function store(OfferRequest $request, Project $project){

        $project_id=$project->id;

        $user = auth()->user();
        if (!$user) {
            return $this->jsonResponse(401, 'Unauthorized', null);
        }

        if (!$project) {
            return $this->jsonResponse(404, 'Project Not Found', null);
        }
         Offer::create([
            'price'       => $request->price,
            'description' => $request->description,
            'period'      => $request->period,
            'user_id'     => $user->id,
            'project_id'  => $project_id,
            'status'      => 'pending'
        ]);
        return $this->jsonResponse(201, 'Offer Created Successfully');
    }
//freelanser (his offer)
    /**
     * Summary of update
     * @param \App\Http\Requests\OfferRequest $request
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(OfferRequest $request,$id)//update offer details by freelanser
    {
        $offer=Offer::findOrfail($id);
        if ($offer->user_id !== auth()->user()->id){
            return $this->jsonResponse(403, 'You are not authorized to update this offer',null);
        }
        $offer->update([
            'price'       => $request->price,
            'description' => $request->description,
            'period'      => $request->period,
        ]);
        return $this->jsonResponse(201, 'Offer Updated Successfully');
    }
//client
    /**
     * Summary of updateStatus
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request,$id)//to update status by client
    {
        $offer=Offer::findOrfail($id);
        $offer->update([
            'status' => $request->status,
        ]);
        $offer_project = $offer->project;
        if ($offer_project->client_id !== auth()->user()->id){
            return $this->jsonResponse(403, 'You are not authorized to update status this offer',null);
        }
        if($offer->status =='accepted'){
            $offer->project->update([
                'freelancer_id' => $offer->user_id,
            ]);
            event(new OfferAccepted($offer));
        }
        return $this->jsonResponse(201, 'Offer Status Updated Successfully', );
    }


//freelanser (his offer)
    /**
     * Summary of restore
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($id)
    {
        $user_id=auth()->user()->id;
        $offer = Offer::withTrashed()->where('user_id',$user_id)->find($id);
        if (!$offer->deleted_at) {
            return $this->jsonResponse(404, 'Offer Not deleted', null);
        }

        $offer->restore();
        return $this->jsonResponse(200, 'Offer Restored Successfully', new OfferResource($offer));
    }
    //admin
    /**
     * Summary of forceDelete
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function forceDelete($id)
    {
        $offer = Offer::withTrashed()->findOrFail($id);
        if ($offer->user_id !== auth()->user()->id){
            return $this->jsonResponse(403, 'You are not authorized to delete this offer',null);
        }
        $offer->forceDelete();
        return $this->jsonResponse(204, 'Offer Deleted Permanently',);
    }
//freelanser (his offer)+admin
    /**
     * Summary of destroy
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)//can delete offer that its status is not accepted
    {
         $offer=Offer::findOrfail($id);
         if ($offer->user_id !== auth()->user()->id){
            return $this->jsonResponse(403, 'You are not authorized to delete this offer',null);
        }
        if ($offer && $offer->status !== 'accepted') {
            $offer->delete();
        }else{
            return $this->jsonResponse(404, 'you can not delete the offer', null);
        }
        return $this->jsonResponse(204, 'Offer Deleted', null);
    }

}
