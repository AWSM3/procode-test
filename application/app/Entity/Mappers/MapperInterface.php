<?php
/**
 * @filename: MapperInterface.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Entity\Mappers;

/** @uses */
use App\Entity\EntityInterface;

/**
 * Interface MapperInterface
 * @package App\Entity\Mappers
 */
interface MapperInterface
{
    /**
     * Hydrate entity object from array
     *
     * @param array $data
     *
     * @return EntityInterface
     */
    public function hydrate(array $data): EntityInterface;

    /**
     * Extract array from entity object
     *
     * @param EntityInterface $entity
     *
     * @return array
     */
    public function extract(EntityInterface $entity): array;
}