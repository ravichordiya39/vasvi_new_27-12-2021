<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $table="user_addresses";
    protected $fillable = [
        'name',
        'mobile',
        'address_type',
        'country_id',
        'state_id',
        'city',
        'area',
        'house',
        'landmark',
        'pincode'
    ];

    public function country(){
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function state(){
        return $this->hasOne(State::class, 'id', 'state_id');
    }

}
