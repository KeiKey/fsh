<?php

namespace App\Models\File;

use App\Models\Share\Share;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait RelationsTrait
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function shares(): HasMany
    {
       return $this->hasMany(Share::class);
    }
}
