<?php

namespace App\Models;

use \DateTimeInterface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Carbon\Carbon;

class Coupon extends Model {
    use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Active',
        '0' => 'Inactive',
    ];

    public const DISCOUNT_TYPE_SELECT = [

        '0' => 'Percentage',
        '1' => 'Flat',
    ];

    public const IS_UNLIMITED = [
        '0' => 'No',
        '1' => 'Yes',
    ];

    public const USER_TYPE_SELECT = [
        '4' => 'NA',
        '0' => 'All Users',
        '1' => 'Existing Users',
        '2' => 'New Users',
    ];

    public const COUPON_TYPE_SELECT = [
        '0' => 'Private',
        '1' => 'Bulk Order',
        '2' => 'Retail Order',
    ];

    public $table = 'coupons';

    protected $appends = [
        'photo',
    ];

    protected $hidden = [
        'image',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = [
        'valid_from',
        'valid_to',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'customer_id',
        'coupon_type',
        'user_type',
        'discount_type',
        'value',
        'valid_from',
        'valid_to',
        'coupon_name',
        'min_cart_amt',
        'code',
        'image',
        'max_discount',
        'is_unlimited',
        'avlb_coupons',
        'status',
        'term_conditions',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // public function registerMediaConversions(Media $media = null): void
    // {
    //     $this->addMediaConversion('thumb')->fit('crop', 50, 50);
    //     $this->addMediaConversion('preview')->fit('crop', 120, 120);
    // }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function getValidFromAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setValidFromAttribute($value)
    {
        $this->attributes['valid_from'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setCustomerIdAttribute($value)
    {
        $this->attributes['coupon_type'] == 0 ?  $value : null;
    }

    public function setUserTypeAttribute($value)
    {
        $this->attributes['coupon_type'] == 0 ? $value : null;
    }

    public function getValidToAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setValidToAttribute($value)
    {
        $this->attributes['valid_to'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

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
    public function getPhotoAttribute() {
        $file = [];

        if ($this->image) {
            $file['url'] = asset("storage/app/public/coupon/$this->image");
            $file['thumb'] = asset("storage/app/public/coupon/thumb/$this->image");
        }

        return (object) $file;
    }


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

}
