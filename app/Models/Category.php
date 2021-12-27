<?php

namespace App\Models;

use \DateTimeInterface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Active',
        '0' => 'Inactive',
    ];

    public $table = 'categories';

    protected $appends = [
        'image_url',
        'thumb_url',
        'size_chart_url',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'image',
        'size_chart',
        'is_home',
        'is_menu',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            // return asset("storage/category/$this->image");
            return asset("file/$this->image");
        }
        return asset("storage/category/no-image.jpg");
    }

    public function getThumbUrlAttribute()
    {
        if ($this->image) {
            // return asset("storage/category/thumb/$this->image");
            return asset("file/$this->image");
        }
        return asset("storage/category/thumb/no-image.jpg");
    }

    public function getSizeChartUrlAttribute()
    {
        if ($this->size_chart) {
            return asset("file/$this->size_chart");
            // return asset("storage/category/$this->size_chart");
        }
    }

    public function getSizeChartThumbAttribute()
    {
        if ($this->size_chart) {
            // return asset("storage/category/thumb/$this->size_chart");
            return asset("file/$this->size_chart");
        }
    }

    public function subcategories()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function scatMapAttribute()
    {
        return $this->hasOne(MapAttribute::class, 'sub_category_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
