<?php

namespace App\Services;

use App\Models\File\File;
use App\Repository\Contracts\FileRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File as FileFacade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileService
{
    private static $fileRepository;

    public function __construct(FileRepositoryInterface $fileRepository)
    {
        self::$fileRepository = $fileRepository;
    }

    /**
     * @param int $fileid
     * @return Model|File|null
     */
    public static function download(int $fileid)
    {
        try {
            $file = self::$fileRepository->findOrFail($fileid);

            return Storage::disk('private')->download($file->path, $file->name);
        } catch (Exception $e) {
            return null;
        }
    }

    public static function restore(int $id)
    {
        return File::withTrashed() -> find($id) -> restore();
    }

    public static function permDelete(int $id)
    {
        $file = File::onlyTrashed()->find($id);
        Storage::disk('private')->delete($file->path);
        return $file->forceDelete();
    }

    public static function upload(UploadedFile $file, int $userId)
    {
        try {
            $fileName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $userId . "/" . $fileName;
            $stored = Storage::disk('private')->put($path, FileFacade::get($file));

            if ($stored) {
                return self::$fileRepository->create([
                    'name' => $file->getClientOriginalName(),
                    'type' => getFileType($file->getClientOriginalExtension()),
                    'size' => $file->getSize(),
                    'path' => $path,
                    'userID' => $userId
                ]);
            }

            return null;
        } catch (Exception $exception) {
            return null;
        }
    }

    /**
     * @param string $filetype
     * @return string
     */
    public static function getFileIcon(string $filetype): string
    {
        switch ($filetype) {
            case "Word":
                return "fa-file-word";
            case "PDF":
                return "fa-file-pdf";
            case "Excel":
                return "fa-file-excel";
            case "Image":
                return "fa-file-image";
            case "Video" :
                return "fa-file-video";
            case "Code" :
                return "fa-file-code";
            case "Audio" :
                return "fa-file-audio";
            case "Archive" :
                return "fa-file-archive";
            case "CSV" :
                return "fa-file-csv";
            case "Text" :
                return "fa-file-alt";
            default:
                return "fa-file";
        }
    }

    /**
     * @param string $extension
     * @return string
     */
    public static function getFileType(string $extension): string
    {
        switch ($extension) {
            case "doc":
            case "docx":
                return "Word";
            case "pdf":
                return "PDF";
            case "xls":
            case "xlsx":
                return "Excel";
            case "jpg":
            case "jpeg":
            case "png":
            case "bmp":
                return "Image";
            case "mp4":
            case "wmv":
            case "avi":
            case "mkv":
            case "flv":
                return "Video";
            case "c":
            case "java":
            case "cpp":
            case "py":
            case "php":
            case "htm":
            case "html":
                return "Code";
            case "mp3":
            case "wav":
                return "Audio";
            case "rar":
            case "zip":
                return "Archive";
            case "csv":
                return "CSV";
            case "txt":
            case "rtf":
                return "Text";
            default:
                return "Other";
        }
    }
}
