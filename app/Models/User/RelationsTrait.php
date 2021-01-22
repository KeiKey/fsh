<?php

namespace App\Models\User;

use App\Models\Share\Share;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait RelationsTrait
{
    public function shares(): HasMany
    {
        $this->hasMany(Share::class);
    }
}
