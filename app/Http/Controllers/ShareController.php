<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShareStoreRequest;
use App\Mail\SharedFile;
use App\Repository\Contracts\FileRepositoryInterface;
use App\Repository\Contracts\ShareRepositoryInterface;
use App\Repository\Contracts\UserRepositoryInterface;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class ShareController extends Controller
{
    /**
     * @var ShareRepositoryInterface
     */
    private $shareRepository;
    /**
     * @var FileRepositoryInterface
     */
    private $fileRepository;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(ShareRepositoryInterface $shareRepository, FileRepositoryInterface $fileRepository, UserRepositoryInterface $userRepository)
    {
        $this->shareRepository = $shareRepository;
        $this->fileRepository = $fileRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $files = $this->fileRepository->sharedWith(auth()->id())->paginate();

        return view('shares.index', compact('files'));
    }

    /**
     * @param ShareStoreRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function store(ShareStoreRequest $request, $id)
    {
        try {
            $user = $this->userRepository->query()->where('email', $request->input('email'))->firstOrFail();
            $file = $this->fileRepository->findOrFail($id);
            if($user->can('share',$file))
                return back()->with(['message' => 'Cannot send to yourself', 'alert-type' => 'warning']);
            else if ($user->can('access',$file))
                return back()->with(['message' => 'This file is already shared with '.$user->name, 'alert-type' => 'warning']);
            else
                $this->shareRepository->create([
                    'user_id' => $user->id,
                    'file_id' => $file->id,
                ]);

            Mail::to($user->email)->send(new SharedFile($user, $file));
            return back()->with(['message' => "Successfully sent", "alert-type" => 'success']);
        } catch (Exception $e) {
            return back()->with(['message' => "Error", "alert-type" => 'error']);
        }
    }
}
