<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Offer;
use App\Http\Resources\OfferResource;

class OfferController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $offers = Offer::where('status','approved')
            ->where('start_date','<=',$today)
            ->where('end_date','>=',$today)
            ->with('company.category')
            ->get();

        return OfferResource::collection($offers);
    }
}
