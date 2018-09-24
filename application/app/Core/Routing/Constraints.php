<?php
/**
 * @filename: Constraints.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Core\Routing;

/**
 * Interface Constraints
 * @package App\Core\Routing
 */
interface Constraints
{
    const
        REGEXP__UUID = '[a-zA-Z0-9-]{36,60}',
        REGEXP__ID   = '[0-9]+';
}