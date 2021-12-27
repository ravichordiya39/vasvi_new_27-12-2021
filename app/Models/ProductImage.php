<?php

namespace App\Models;

use \DateTimeInterface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product;

class ProductImage extends Model {
    use HasFactory;

    public const TYPE_SELECT = [
        '1' => 'Image',
        '2' => 'File (Docx / PDF)',
        '3' => 'Audio',
        '4' => 'Video',
        '5' => 'Text',
    ];

    public $table = 'product_images';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'product_id',
        'type',
        'file_name',
        'created_at',
        'updated_at',
        'deleted_at',
        'product_color_id'
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

    // public function getFileNameAttribute()
    // {
    //     return $this->getMedia('file_name');
    // }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    // public function destroy($id)
    // {
    //     try {
    //         $ids = explode(",", $id);
    //         ProductImage::where()->delete();
    //     }
    //     catch(Exception $er) {
    //         \Log::error($er);
    //     }
    // }
}
