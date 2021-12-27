<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Active',
        '0' => 'Inactive',
    ];

    public $table = 'blogs';

    protected $appends = [
        'icon',
    ];

    protected $hidden = [
        'image',
    ];

    protected $dates = [
        'published_on',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'sub_title',
        'slug',
        'image',
        'description',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'tags',
        'published_on',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // public function registerMediaConversions(Media $media = null): void
    // {
    //     $this->addMediaConversion('thumb')->fit('crop', 50, 50);
    //     $this->addMediaConversion('preview')->fit('crop', 120, 120);
    // }

    // public function getImageAttribute()
    // {
    //     $file = $this->getMedia('image')->last();
    //     if ($file) {
    //         $file->url       = $file->getUrl();
    //         $file->thumbnail = $file->getUrl('thumb');
    //         $file->preview   = $file->getUrl('preview');
    //     }

    //     return $file;
    // }
    public function getIconAttribute()
    {
        $file = [];

        if ($this->image) {
            // $file['url'] = asset("storage/blog/$this->image");
            // $file['thumb'] = asset("storage/blog/thumb/$this->image");
            $file['url'] = asset("file/$this->image");
            $file['thumb'] = asset("file/$this->image");
        }

        return (object) $file;
    }

    public function getPublishedOnAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setPublishedOnAttribute($value)
    {
        $this->attributes['published_on'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
