<?php

namespace App\Models;

use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;

class KnewsLetters extends BaseModel
{
    use HasMedia;

    protected $with = [
        'media',
    ];
    protected $guarded = ['id'];

    protected $casts = [
        'active' => 'boolean',
    ];

}
