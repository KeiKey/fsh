<?php

namespace App\Models\Share;

use App\Models\File\File;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait RelationsTrait
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }
}
