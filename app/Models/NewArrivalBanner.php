<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewArrivalBanner extends Model
{
    use HasFactory;

    protected $table = 'new_arrival_banners';

    protected $fillable = [
        'link',
        'image',
        'created_at',
        'updated_at'
    ];
}
