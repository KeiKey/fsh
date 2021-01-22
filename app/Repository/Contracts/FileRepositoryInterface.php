<?php

namespace App\Repository\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface FileRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $userId
     * @return Builder
     */
    public function whereUserId(int $userId);
    public function whereDeleted(int $userId);
    public function sharedWith(int $userId);

}
