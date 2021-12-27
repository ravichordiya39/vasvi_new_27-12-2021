<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatestBanner extends Model
{
    use HasFactory;

    protected $table = 'latest_banners';

    protected $fillable = [
        'link',
        'image',
        'created_at',
        'updated_at'
    ];
}
