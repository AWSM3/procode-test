<?php
/**
 * @filename: FileMapper.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Entity\Mappers;

/** @uses */
use App\Core\Storage\StoredFile;
use App\Entity\EntityInterface;
use App\Entity\File;

/**
 * Class FileMapper
 * @package App\Entity\Mappers
 */
class FileMapper implements MapperInterface
{
    /**
     * @inheritdoc
     *
     * @return File
     * @throws \Exception
     */
    public function hydrate(array $data): EntityInterface
    {
        if (!$data['stored_file'] instanceof StoredFile) {
            $storedFileRaw = json_decode($data['stored_file'], true);
            $storedFile = new StoredFile($storedFileRaw['local'], $storedFileRaw['public'], $storedFileRaw['hash']);
        } else {
            $storedFile = $data['stored_file'];
        }

        return new File($data['hash'], $storedFile, $data['id'] ?? null);
    }

    /**
     * @inheritdoc
     *
     * @param File $entity
     */
    public function extract(EntityInterface $entity): array
    {
        return [
            'id'          => $entity->getId(),
            'hash'        => $entity->getHash(),
            'stored_file' => $entity->getStoredFile()->toJson(),
        ];
    }
}