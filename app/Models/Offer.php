<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'company_id',
        'title',
        'regular_price',
        'offer_price',
        'start_date',
        'end_date',
        'limit_date',
        'coupon_limit',
        'description',
        'details',
        'status'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'limit_date' => 'datetime'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    public function purchases()
    {
        return $this->hasManyThrough(Purchase::class, Coupon::class);
    }
}