<?php

namespace App\Repository\Classes;

use App\Models\File\File;
use App\Repository\Contracts\FileRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileRepository extends Repository implements FileRepositoryInterface
{
    protected function model()
    {
        return File::class;
    }

    /**
     * @param int $userId
     * @return Builder
     */
    public function whereUserId(int $userId)
    {
        return $this->model->where('userID', $userId);
    }

    /**
     * @param int $userId
     * @return File|Builder
     */
    public function whereDeleted(int $userId)
    {
        return $this->model->onlyTrashed()->where('userID', $userId);
    }

    /**
     * @param int $userId
     * @return Builder|Model|SoftDeletes
     */
    public function sharedWith(int $userId)
    {
        return $this->model->whereHas('shares', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        });
    }
}
