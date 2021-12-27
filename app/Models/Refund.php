<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;

    protected $table = 'refunds';

    protected $fillable = [
       'refund_id',
       'payment_id',
       'notes',
       'receipt',
       'status',
       'speed_requested',
       'created_at',
       'updated_at'
    ];
}
