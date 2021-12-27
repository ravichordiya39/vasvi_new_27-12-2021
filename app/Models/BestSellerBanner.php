<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BestSellerBanner extends Model
{
    use HasFactory;

    protected $table = 'best_seller_banners';

    protected $fillable = [
        'link',
        'image',
        'created_at',
        'updated_at'
    ];
}
