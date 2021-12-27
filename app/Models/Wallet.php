<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    protected $table = 'wallets';

    protected $fillable = [
        'user_id',
        'amount',
        'created_at',
        'updated_at'
    ];

    public function users()
    {
        return $this->hasOne(User::class,'id', 'user_id');
    }
}
