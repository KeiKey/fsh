<?php

namespace App\Policies;

use App\Models\File\File;
use App\Models\User\User;
use App\Repository\Contracts\FileRepositoryInterface;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
    use HandlesAuthorization;

    public function share(User $user, File $file)
    {
        return $user->id === $file->userID;
    }

    public function access(User $user, File $file)
    {
        return $user->id === $file->userID || $file->shares()->where('user_id',$user->id)->exists();
    }

}
