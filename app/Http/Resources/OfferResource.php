<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CompanyResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */


    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'regular_price' => $this->regular_price,
            'offer_price' => $this->offer_price,
            'description' => $this->description,
            'company' => [
                'id' => $this->company->id,
                'name' => $this->company->name,
                'category' => [
                    'id' => $this->company->category->id,
                    'name' => $this->company->category->name,
                ]   
            ]
        ];
    }
}
