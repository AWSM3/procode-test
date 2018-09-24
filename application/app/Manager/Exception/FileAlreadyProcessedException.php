<?php
/**
 * @filename: FileAlreadyProcessedException.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Manager\Exception;

/** @uses */
use App\Entity\File;

/**
 * Class FileAlreadyProcessedException
 * @package App\Manager\Exception
 */
class FileAlreadyProcessedException extends \RuntimeException
{
    /** @var File */
    protected $fileEntity;

    /**
     * @return File
     */
    public function getFileEntity(): File
    {
        return $this->fileEntity;
    }

    /**
     * @param File $fileEntity
     *
     * @return FileAlreadyProcessedException
     */
    public function setFileEntity(File $fileEntity): FileAlreadyProcessedException
    {
        $this->fileEntity = $fileEntity;

        return $this;
    }
}