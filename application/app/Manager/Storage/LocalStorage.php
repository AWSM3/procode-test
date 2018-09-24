<?php
/**
 * @filename: LocalStorage.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Manager\Storage;

/** @uses */
use App\Core\Storage\StorageInterface;
use App\Core\Storage\StoredFile;
use Slim\Http\UploadedFile;

/**
 * Class LocalStorage
 * @package App\Manager\Storage
 */
class LocalStorage implements StorageInterface
{
    const
        FILE_HASH_ALGORITHM = 'md5';

    /** @var string */
    private $defaultDir;
    /** @var string */
    private $public;

    /**
     * LocalStorage constructor.
     *
     * @param string $defaultDir
     * @param string $public
     */
    public function __construct(string $defaultDir, string $public)
    {
        $this->defaultDir = $defaultDir;
        $this->public = $public;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param string       $directory Директория назначения
     *
     * @return StoredFile
     * @throws \Exception
     */
    public function moveUploadedFile(UploadedFile $uploadedFile, string $directory = null): StoredFile
    {
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        $basename = bin2hex(random_bytes(8));
        $filename = sprintf('%s.%s', $basename, $extension);

        $directory = $directory ?? $this->defaultDir;
        $absolutePath = $directory . DIRECTORY_SEPARATOR . $filename;
        $uploadedFile->moveTo($absolutePath);

        return new StoredFile($absolutePath, $this->makePublicPath($filename), $this::hashFile($absolutePath));
    }

    /**
     * @param string $filename
     *
     * @return string
     */
    protected function makePublicPath(string $filename): string
    {
        return $this->public.'/'.$filename;
    }

    /**
     * @param string $filename
     *
     * @return string
     */
    public static function hashFile(string $filename): string
    {
        return hash_file('md5', $filename);
    }
}