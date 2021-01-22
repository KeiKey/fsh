<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Repository\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class APIController extends Controller
{
    private $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return (new UserCollection($this->userRepository->all()))->response();
    }

}
