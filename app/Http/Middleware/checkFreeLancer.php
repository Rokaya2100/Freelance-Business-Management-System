<?php

namespace App\Http\Middleware;

use App\Http\Traits\jsonTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Offer;

class checkFreeLancer
{ use jsonTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $offer = $request->route('offer'); // Adjust this based on your route parameter
        $freelancer = auth()->user(); // Get the authenticated freelancer

        // Check if the offer exists
        $offer1=Offer::find($offer);
        if (!$offer1) {
            return $this->jsonResponse(404, 'Offer not found', null); // Offer not found response
        }

        // Check if the freelancer is the owner of the offer
        if ($offer1->user_id === $freelancer->id) {
            return $next($request); // Allow the request to proceed
        } else {
            return $this->jsonResponse(403, 'Forbidden', null); // Forbidden response
        }
    }
}
