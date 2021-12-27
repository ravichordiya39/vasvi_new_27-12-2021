<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Active',
        '0' => 'Inactive',
    ];

    public $table = 'stores';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'contact_person_name',
        'contact_person_number',
        'contact_person_designation',
        'address',
        'store_pin_code',
        'store_contact',
        'open_time',
        'close_time',
        'pin_codes',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'latitude',
        'longitude',
        'city_id',
        'iframe',
        'location',
        'image'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function city()
    {
      return $this->hasOne(City::class,'id','city_id');
    }
}
