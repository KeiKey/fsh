<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Mail\NowAdmin;
use App\Models\User\User;
use App\Repository\Contracts\UserRepositoryInterface;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    private $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return Factory|JsonResponse|View
     * @throws Exception
     */
    public function index()
    {
        if (request()->ajax() || request()->wantsJson()) {
            $users = $this->userRepository->query()->orderBy('role');

            return DataTables::eloquent($users)
                ->addColumn('actions', 'admin.users.actions')
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.users.index');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(int $id)
    {
        $user = $this->userRepository->findOrFail($id);

        $user->delete();
        $notification = array(
            'message' => 'User deleted',
            'alert-type' => 'error'
        );

        return back()->with($notification);

    }

    public function promote(int $id)
    {
        /** @var User $user */
        $user = $this->userRepository->findOrFail($id);
        $user->update(['role' => RoleEnum::ADMINISTRATOR]);
        $notification = array(
            'message' => 'User was promoted to admin',
            'alert-type' => 'success'
        );
        Mail::to($user->email)->send(new NowAdmin());
        return back()->with($notification);
    }

    public function demote(int $id)
    {
        /** @var User $user */
        $user = $this->userRepository->findOrFail($id);
        $user->update(['role' => RoleEnum::USER]);
        $notification = [
            'message' => 'User was demoted',
            'alert-type' => 'info'
        ];

        return back()->with($notification);
    }
}
