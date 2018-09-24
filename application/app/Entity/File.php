<?php
/**
 * @filename: File.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Entity;

/** @uses */
use App\Core\Storage\StoredFile;
use Ramsey\Uuid\Uuid;

/**
 * Class File
 * @package App\Entity
 */
class File implements EntityInterface
{
    /** @var string UUID */
    protected $id;
    /** @var string MD5 hash */
    protected $hash;
    /** @var StoredFile Данные о файле */
    protected $storedFile;

    /**
     * File constructor.
     *
     * @param string      $hash
     * @param StoredFile  $storedFile
     * @param null|string $id
     *
     * @throws \Exception
     */
    public function __construct(string $hash, StoredFile $storedFile, ?string $id = null)
    {
        $this->id = $id ?? (string)Uuid::uuid4();
        $this->hash = $hash;
        $this->storedFile = $storedFile;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return StoredFile
     */
    public function getStoredFile(): StoredFile
    {
        return $this->storedFile;
    }
}