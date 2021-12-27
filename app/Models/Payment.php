<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\UserOrder;

class Payment extends Model
{
    use HasFactory;

    public function users(){
      return $this->hasOne(User::class, 'id','user_id');
    }


    public function orders(){
      return $this->hasOne(UserOrder::class, 'id','order_id');
    }
}
