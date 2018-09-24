<?php
/**
 * @filename: FilePageMapper.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Entity\Mappers;

/** @uses */
use App\Entity\EntityInterface;
use App\Entity\File;
use App\Entity\FilePage;
use App\Repository\Interfaces\FileRepositoryInterface;

/**
 * Class FilePageMapper
 * @package App\Entity\Mappers
 */
class FilePageMapper implements MapperInterface
{
    /** @var FileRepositoryInterface */
    private $fileRepository;

    /**
     * FilePageMapper constructor.
     *
     * @param FileRepositoryInterface $fileRepository
     */
    public function __construct(FileRepositoryInterface $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    /**
     * @inheritdoc
     *
     * @return FilePage
     * @throws \Exception
     */
    public function hydrate(array $data): EntityInterface
    {
        $file = $data['file'];
        if (!$file instanceof File) {
            /** @var File $file */
            $file = $this->fileRepository->get($data['file']);
        }

        return new FilePage($file, (int)$data['page'], $data['content'], $data['id'] ?? null);
    }

    /**
     * @inheritdoc
     *
     * @param FilePage $entity
     *
     * @return array
     */
    public function extract(EntityInterface $entity): array
    {
        return [
            'id'      => $entity->getId(),
            'file'    => $entity->getFile()->getId(),
            'page'    => $entity->getPage(),
            'content' => $entity->getContent(),
        ];
    }
}