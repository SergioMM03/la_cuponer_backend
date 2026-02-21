<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\OfferResource;

class CouponResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray($request)
    {
        return [
            'code' => $this->code,
            'status' => $this->status,
            'expiration_date' => $this->expiration_date,
            'offer' => new OfferResource($this->offer)
        ];
    }
}
