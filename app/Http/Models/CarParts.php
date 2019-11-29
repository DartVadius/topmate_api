<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarParts extends Model
{
    protected $table = 'car_parts';

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    use SoftDeletes;

    public function models()
    {
        return $this->belongsToMany('App\Http\Models\CarModels', 'car_consumption', 'part_id', 'model_id')
            ->withPivot('sqft', 'sqm')
            ->withTimestamps();
    }
}
