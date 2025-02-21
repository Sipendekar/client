<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    public $table = "tbl_form";

    protected $primarykey = 'id';

    protected $fillable = [
        'name',
        'province_code',
        'city_id',
        'address',
        'image',
    ];
}
