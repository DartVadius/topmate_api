<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarConsumption extends Model
{
    protected $table = 'car_consumption';

    protected $fillable = [
        'model_id', 'part_id', 'sqft', 'sqm'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    use SoftDeletes;
}
