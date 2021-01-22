<?php

namespace App\Repository\Classes;

use App\Models\Share\Share;
use App\Repository\Contracts\ShareRepositoryInterface;

class ShareRepository extends Repository implements ShareRepositoryInterface
{
    protected function model()
    {
        return Share::class;
    }
}
