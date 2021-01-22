<?php

namespace App\Http\Controllers;

use App\Models\File\File;
use App\Repository\Contracts\FileRepositoryInterface;
use App\Services\FileService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class FilesController extends Controller
{
    private $fileRepository;

    /**
     * @param FileRepositoryInterface $fileRepository
     */
    public function __construct(FileRepositoryInterface $fileRepository)
    {
        $this->fileRepository = $fileRepository;
        $this->authorizeResource(File::class, 'file');
    }

    /**
     * @return Application|Factory|JsonResponse|View
     * @throws Exception
     *
     */
    public function index()
    {
        if (request()->ajax() || request()->wantsJson()) {
            $files = $this->fileRepository->whereUserId(auth()->id());

            return DataTables::eloquent($files)
                ->addColumn('actions', 'files.actions')
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('files.index');
    }

    public function upload()
    {
        return view('files.upload');
    }

    public function uploadPost(Request $request)
    {
        FileService::upload($request->file('file'), auth()->id());

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function showAll()
    {
        $files = $this->fileRepository->whereUserId(auth()->id())->paginate();

        return view('files.all', compact('files'));
    }

    public function showTrash()
    {
        $files = $this->fileRepository->whereDeleted(auth()->id())->paginate();
        return view('files.trash', compact('files'));
    }

    public function download(int $id)
    {
        $file = $this->fileRepository->findOrFail($id);
        $this->authorize('access', $file);
        return FileService::download($id);

    }

    public function softDelete(int $id)
    {
        $file = $this->fileRepository->findOrFail($id);
        try {
            $file->delete();
            $notification = array(
                'message' => 'Item moved to trash',
                'alert-type' => 'warning'
            );
            return back()->with($notification);
        } catch (Exception $e) {
        }
    }

    public function restore(int $id)
    {
        FileService::restore($id);
        $notification = array(
            'message' => 'Item restored',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function permDelete(int $id)
    {
        FileService::permDelete($id);
        $notification = array(
            'message' => 'File Permanently Deleted',
            'alert-type' => 'error'
        );
        return back()->with($notification);
    }


    public function share(int $id)
    {
        $file = $this->fileRepository->findOrFail($id);
        $this->authorize('share', $file);
        return view('files.share', compact('file'));
    }
}
