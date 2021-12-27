<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeBestSeller extends Model
{
    use HasFactory;
    protected $table="banners_bestsellers";
    protected $fillable=['link','image'];
    
}
