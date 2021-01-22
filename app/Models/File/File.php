<?php

namespace App\Models\File;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property User $user
 */
class File extends Model
{
    use AttributesTrait,
        RelationsTrait,
        SoftDeletes;

    protected $fillable = [
        'path',
        'name',
        'size',
        'type',
        'userID'
    ];

    protected $appends = [
        'size_in_mb',
    ];
    /**
     * @var mixed
     */
    private $user;
    /**
     * @var mixed
     */
    private $user_id;
    /**
     * @var mixed
     */
    private $userID;
}
