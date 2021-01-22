<?php

namespace App\Repository\Classes;

use App\Models\User\User;
use App\Repository\Contracts\UserRepositoryInterface;

class UserRepository extends Repository implements UserRepositoryInterface
{
    protected function model()
    {
        return User::class;
    }
}
