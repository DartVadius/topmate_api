<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    protected $table = 'faq';

    protected $fillable = [
        'question_en', 'answer_en'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    use SoftDeletes;
}
