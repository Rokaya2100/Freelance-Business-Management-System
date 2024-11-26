<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use Symfony\Component\HttpFoundation\Response;

class CheckFreelancers
{
    use jsonTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $offerId = $request->route('id');
         $offer=Offer::withTrashed()->findOrfail($offerId);


        // Check if the freelancer is the owner of the offer
        if ($offer->user_id === auth()->user()->id) {

         return $next($request); // Allow the request to proceed
        } else {
             return $this->jsonResponse(403, 'you must be the owner of this offer to do it', null); // Forbidden response

        }

    }
}
