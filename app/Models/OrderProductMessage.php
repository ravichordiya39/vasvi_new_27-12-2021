<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProductMessage extends Model
{
    use HasFactory;

    protected $table = 'order_product_messages';

    protected $fillable = [
        'order_product_id',
        'sender',
        'created_at',
        'updated_at',
        'message',
        'recipient'
    ];
}
