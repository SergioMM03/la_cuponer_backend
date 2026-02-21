<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'offer_id','purchase_id','code','status','expiration_date'
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
