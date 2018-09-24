<?php
/**
 * @filename: StoredFile.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Core\Storage;

/**
 * Class StoredFile
 * @package App\Core\Storage
 */
class StoredFile
{
    /** @var string Локальный путь до файла */
    protected $local;
    /** @var string Публичный адрес файла */
    protected $public;
    /** @var string MD5 */
    protected $hash;

    /**
     * StoredFile constructor.
     *
     * @param string $local
     * @param string $public
     * @param string $hash
     */
    public function __construct(string $local, string $public, string $hash)
    {
        $this->local = $local;
        $this->public = $public;
        $this->hash = $hash;
    }

    /**
     * @return string
     */
    public function getLocal(): string
    {
        return $this->local;
    }

    /**
     * @return string
     */
    public function getPublic(): string
    {
        return $this->public;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'local'  => $this->getLocal(),
            'public' => $this->getPublic(),
            'hash'   => $this->getHash(),
        ];
    }

    /**
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE);
    }
}