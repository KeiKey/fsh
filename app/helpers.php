<?php

use App\Services\FileService;

if (!function_exists("getFileIcon")) {
    function getFileIcon(string $filetype): string
    {
        return FileService::getFileIcon($filetype);
    }
}

if (!function_exists('getFileType')) {
    function getFileType(string $extension): string
    {
        return FileService::getFileType($extension);
    }
}
