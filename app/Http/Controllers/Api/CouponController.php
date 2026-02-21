<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Http\Resources\CouponResource;


class CouponController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $client = $user->client;

        $coupons = Coupon::whereHas('purchase', function($q) use ($client){
            $q->where('client_id',$client->id);
        })->with('offer')->get();

        return CouponResource::collection($coupons);
    }
}
