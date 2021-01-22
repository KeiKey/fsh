<?php

namespace App\Http\Middleware;

use App\Repository\Contracts\FileRepositoryInterface;
use Closure;
use Illuminate\Http\Request;

class CheckStorageUsed
{
    private $fileRepository;

    public function __construct(FileRepositoryInterface $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $space = $this->fileRepository->query()->where('userID', $request->user()->id)->sum('size');
        if ($space < 100 * 1024 * 1024)
            return $next($request);
        return redirect()->route('dashboard.index')->with(['message'=>"You have reached maximum capacity", 'alert-type' => 'error']);

    }
}
