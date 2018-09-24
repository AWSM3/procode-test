<?php
/**
 * @filename: FilePage.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Entity;

/** @uses */
use Ramsey\Uuid\Uuid;

/**
 * Class FilePage
 * @package App\Entity
 */
class FilePage implements EntityInterface
{
    /** @var string UUID */
    protected $id;
    /** @var File */
    protected $file;
    /** @var int Page */
    protected $page;
    /** @var string Content */
    protected $content;

    /**
     * FilePage constructor.
     *
     * @param File        $file
     * @param int         $page
     * @param string      $content
     * @param null|string $id
     *
     * @throws \Exception
     */
    public function __construct(File $file, int $page, string $content, ?string $id = null)
    {
        $this->id = $id ?? (string)Uuid::uuid4();
        $this->file = $file;
        $this->page = $page;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return File
     */
    public function getFile(): File
    {
        return $this->file;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}