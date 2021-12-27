<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Page;

class PolicyPage extends Model
{
    use HasFactory;

    protected $table = 'policy_pages';

    protected $fillable = [
        'page_id',
        'order_no',
        'created_at',
        'updated_at'
    ];

    public function pages(){
        return $this->hasOne(Page::class, 'id', 'page_id');
    }
}
