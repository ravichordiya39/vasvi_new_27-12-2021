<?php

namespace App\Models;

use \DateTimeInterface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model {
    use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Active',
        '0' => 'Inactive',
    ];

    public $table = 'brands';

    // protected $appends = [
    //     'logo_url','thumb_url'
    // ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'logo',
        'description',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getLogoUrlAttribute() {
        if ($this->logo) {
            // return asset("storage/brand/$this->logo");
            return asset("file/$this->logo");
        }
    }

    public function getThumbUrlAttribute() {
        if ($this->logo) {
            // return asset("storage/brand/thumb/$this->logo");
            return asset("file/$this->logo");
        }
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
