<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    protected $table = 'referrals';

    protected $fillable = [
        'ref_id',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function referralUser()
    {
        return $this->hasOne(User::class,'id','ref_id');
    }

    public function targetUser()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
