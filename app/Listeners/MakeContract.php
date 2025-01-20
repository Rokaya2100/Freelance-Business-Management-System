<?php

namespace App\Listeners;

use App\Models\Offer;
use App\Models\Contract;
use App\Events\OfferAccepted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MakeContract
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    /**
     * Summary of handle
     * @param \App\Events\OfferAccepted $event
     * @throws \Exception
     * @return void
     */
    public function handle(OfferAccepted $event): void
    {
        $acceptedOffer = $event->offer;

        if (!$acceptedOffer->project_id) {
            throw new \Exception('Project ID is missing from the accepted offer.');
        }

        Offer::where('project_id', $acceptedOffer->project_id)
            ->where('id', '!=', $acceptedOffer->id)->update(['status' => 'rejected']);
            $offer = Offer::where('project_id', '=',$acceptedOffer->project_id)->where('id','=',$acceptedOffer->id)->first(); // Use first() to get a single offer


        $contractData = [

            'project_id' => $offer->project_id,
            'freelancer_id' => $offer->user_id,
            'client_id' => $offer->project->client_id,
            'price' => $offer->price,
        ];
        Contract::create($contractData);






    }
}
