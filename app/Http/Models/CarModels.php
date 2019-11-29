<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarModels extends Model
{
    protected $table = 'car_models';

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    use SoftDeletes;

    public function parts()
    {
        return $this->belongsToMany('App\Http\Models\CarParts', 'car_consumption', 'model_id', 'part_id')
            ->withPivot('sqft', 'sqm')
            ->withTimestamps();
    }
}
