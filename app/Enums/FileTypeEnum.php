<?php


namespace App\Enums;


class FileTypeEnum extends Enum
{
    public const WORD = 'Word';
    public const EXCEL = 'Excel';
    public const PDF = 'PDF';
    public const IMAGE = 'Image';
    public const VIDEO = 'Video';
    public const CODE = 'Code';
    public const AUDIO = 'Audio';
    public const ARCHIVE = 'Archive';
    public const CSV = 'CSV';
    public const TEXT = 'Text';
    public const OTHER = 'Other';

    public static function default()
    {
        return self::OTHER;
    }
}
