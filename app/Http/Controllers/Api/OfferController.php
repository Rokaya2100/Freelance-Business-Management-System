<?php

namespace App\Http\Controllers\Api;

use App\Events\OfferAccepted;
use App\Http\Resources\OfferCollection;
use App\Models\Offer;
use App\Models\Project;
use App\Http\Traits\jsonTrait;
use App\Http\Requests\OfferRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;

class OfferController extends Controller
{
    use jsonTrait;

    public function index()//admin
    {

        $offers = Offer::paginate(5);
        if($offers->isEmpty()){
            return $this->jsonResponse(404, 'No Offers Found', null);
        }
        return $this->jsonResponse(200, 'All Offers', new OfferCollection($offers));
    }

    //admin+freelanser+client
    public function getProjectOffers(Project $project)//to get all offers that related to this project
    {
        if($project->offers->isEmpty()){
            return $this->jsonResponse(404, 'No Offers Found', null);
        }
        $projectOffers = $project->offers()->paginate(3);
        return $this->jsonResponse(200, 'All Offers that Related to this Project', new OfferCollection($projectOffers));
    }

    public function show(Offer $offer){
        if (!$offer) {
            return $this->jsonResponse(404, 'Offer Not Found', null);
        }
        return $this->jsonResponse(200, 'Offer Details', new OfferResource($offer));
    }
//freelanser
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
    public function update(OfferRequest $request,$id)//update offer details by freelanser
    {
        $offer=Offer::findOrfail($id);

        $offer->update([
            'price'       => $request->price,
            'description' => $request->description,
            'period'      => $request->period,
        ]);
        return $this->jsonResponse(201, 'Offer Updated Successfully', );
    }
//client
    public function updateStatus(OfferRequest $request,$id)//to update status by client
    {
        $offer=Offer::findOrfail($id);

        $offer->update([
            'status' => $request->status,
            'price'       => $offer->price,
            'description' => $offer->description,
            'period'      => $offer->period,
            'user_id'     => $offer->user_id,
            'project_id'  => $offer->project_id,

        ]);
        if($offer->status =='accepted')
            event(new OfferAccepted($offer));
        return $this->jsonResponse(201, 'Offer Status Updated Successfully', );
    }


//freelanser (his offer)
    public function restore($id){
        $user_id=auth()->user()->id;
        $offer = Offer::withTrashed()->where('user_id',$user_id)->find($id);
        if (!$offer->deleted_at) {
            return $this->jsonResponse(404, 'Offer Not deleted', null);
        }

        $offer->restore();
        return $this->jsonResponse(200, 'Offer Restored Successfully', new OfferResource($offer));
    }
    //admin
    public function forceDelete($id){
        $offer = Offer::withTrashed()->findOrFail($id);
        $offer->forceDelete();
        return $this->jsonResponse(204, 'Offer Deleted Permanently',);
    }
//freelanser (his offer)+admin
    public function destroy($id)//can delete offer that its status is not accepted
    {
         $offer=Offer::findOrfail($id);
        if ($offer && $offer->status !== 'accepted') {
            $offer->delete();
        }else{
            return $this->jsonResponse(404, 'you can not delete the offer', null);
        }
        return $this->jsonResponse(204, 'Offer Deleted', null);
    }



    //freelanser
public function freeOffersDeleted(){
    $user_id=auth()->user()->id;
    $offers = Offer::onlyTrashed()->where('user_id',$user_id)->get();
    return $this->jsonResponse(204, ' my Offers were Deleted ',$offers);
}
//admin
    public function offersDeleted($user_id){
        $offers = Offer::onlyTrashed()->where('user_id',$user_id)->get();
        return $this->jsonResponse(204, 'Offers were Deleted by this freelanser',$offers);
    }


}
