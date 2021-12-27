<?php

namespace App\Models;

use \DateTimeInterface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MapAttribute extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Active',
        '0' => 'Inactive',
    ];

    public $table = 'map_attributes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'sub_category_child_id',
        'is_size',
        'sizes',
        'is_color',
        'colors',
        'is_brand',
        'brands',
        'is_attribute',
        'attributes',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'colors' => 'array',
        'sizes' => 'array',
        'brands' => 'array',
        'attributes' => 'array'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'sub_category_id', 'id');
    }
    public function subchildcategory()
    {
        return $this->belongsTo(Category::class, 'sub_category_child_id', 'id');
    }
}
