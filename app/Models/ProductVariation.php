<?php

namespace App\Models;

use \DateTimeInterface;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVariation extends Model {
    // use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Active',
        '0' => 'Inactive',
    ];

    public const IN_STOCK_SELECT = [
        '1' => 'In Stock',
        '0' => 'Out of Stock',
    ];

    public $table = 'product_variations';

    protected $appends = [
        'front_image',
        'back_image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'product_id',
        'color_id',
        'size_id',
        'single_price',
        'single_sales_price',
        'wholesale_price',
        'wholesale_sales_price',
        'single_price_quantity',
        'wholesale_price_quantity',
        'qty',
        'size_status',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'primary_variation',
    ];

    // public function registerMediaConversions(Media $media = null): void
    // {
    //     $this->addMediaConversion('thumb')->fit('crop', 50, 50);
    //     $this->addMediaConversion('preview')->fit('crop', 120, 120);
    // }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function getFrontImageAttribute()
    {
        // $file = $this->getMedia('front_image')->last();
        // if ($file) {
        //     $file->url       = $file->getUrl();
        //     $file->thumbnail = $file->getUrl('thumb');
        //     $file->preview   = $file->getUrl('preview');
        // }

        return ;
    }

    public function getBackImageAttribute()
    {
        // $file = $this->getMedia('back_image')->last();
        // if ($file) {
        //     $file->url       = $file->getUrl();
        //     $file->thumbnail = $file->getUrl('thumb');
        //     $file->preview   = $file->getUrl('preview');
        // }

        return ;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
