<?php
/**
 * @filename: StorageInterface.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Core\Storage;

use Slim\Http\UploadedFile;

/**
 * Interface StorageInterface
 * @package App\Core\Storage
 */
interface StorageInterface
{
    /**
     * @param UploadedFile $uploadedFile
     * @param string       $directory Директория назначения
     *
     * @return StoredFile
     * @throws \Exception
     */
    function moveUploadedFile(UploadedFile $uploadedFile, string $directory = null): StoredFile;
}