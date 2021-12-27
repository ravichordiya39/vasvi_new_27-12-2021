<?php

namespace App\Models;

use \DateTimeInterface;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\ProductReview;

class Product extends Model {
    // use SoftDeletes;

    public const HAS_VARIENT_SELECT = [
        '1' => 'yes',
        '0' => 'No',
    ];


    public function sluggable(): array
    {
       return [
           'slug' => [
               'source' => 'name'
           ]
       ];
    }

    public const STATUS_SELECT = [
        '1' => 'Active',
        '0' => 'Inactive',
    ];

    public const DISCOUNT_TYPE_SELECT = [
        '1' => 'Percentage',
        '2' => 'Flat',
    ];

    public const IN_STOCK_SELECT = [
        '1' => 'In Stock',
        '0' => 'Out of Stock',
    ];

    public $table = 'products';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'sub_category_child_id',
        'user_id',
        'name',
        'slug',
        'sku_code',
        'hsn_code',
        'brand_id',
        'mrp_price',
        'tax_rate',
        'discount_type',
        'discount',
        'sales_price',
        'in_stock',
        'is_bulk',
        'is_exclusive',
        'is_featured',
        'is_new',
        'has_varient',
        'description',
        'specification',
        'front_image',
        'back_image',
        'view_count',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'details',
        'care_and_disclaimer'
    ];

    protected $append = [
        'front_image_url',
        'front_thumb_url',
        'back_image_url',
        'back_thumb_url'
    ];

    public function getFrontImageUrlAttribute() {
        if ($this->front_image) {
            return asset("file/$this->front_image");
        }
    }

    public function getFrontThumbUrlAttribute() {
        if ($this->front_image) {
            return asset("file/$this->front_image");
        }
    }
    public function getBackImageUrlAttribute() {
        if ($this->back_image) {
            return asset("file/$this->back_image");
        }
    }

    public function getBackThumbUrlAttribute() {
        if ($this->back_image) {
            return asset("file/$this->back_image");
        }
    }


    public function productProductImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }



    public function productProductVariations()
    {
        return $this->hasMany(ProductVariation::class, 'product_id', 'id');
    }

    public function productProductAttributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id','id');
    }

    public function sub_category()
    {
        return $this->belongsTo(Category::class, 'sub_category_id');
    }
    public function child_category()
    {
        return $this->belongsTo(Category::class, 'sub_category_child_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }


}
