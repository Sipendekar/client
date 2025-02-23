<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    public $table = "tbl_form";

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'province_code',
        'city_id',
        'address',
        'image',
        'damage_type',
        'size',
        'repair_time',
        'material',
        'quantity',
        'quantity_unit'
    ];
}
