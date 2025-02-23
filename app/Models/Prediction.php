<?php
// app/Models/Prediction.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    protected $fillable = [
        'form_id',
        'damage_type',
        'size',
        'repair_time',
        'material',
        'quantity',
        'quantity_unit'
    ];

    protected $casts = [
        'size' => 'array'
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}