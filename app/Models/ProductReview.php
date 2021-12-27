<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    protected $table =  'product_reviews';

    protected $fillable = [
        'user_id',
        'product_id',
        'title',
        'rating',
        'comment',
        'recommended'
    ];


    public function users(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

}
