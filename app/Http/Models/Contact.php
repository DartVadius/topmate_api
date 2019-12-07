<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    protected $table = 'contact';

    protected $fillable = [
        'name', 'email', 'subject', 'message'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    use SoftDeletes;
}
