<?php

namespace App\Models;

use \DateTimeInterface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CurrierCompany extends Model {

    use HasFactory;

    protected $table = "currier_companies";
}
