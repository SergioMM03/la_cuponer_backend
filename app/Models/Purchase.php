<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['client_id','total_amount'];

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
