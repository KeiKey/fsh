<?php

namespace App\Models\Share;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    use RelationsTrait;

    protected $fillable = [
        'file_id',
        'user_id'
    ];
}
