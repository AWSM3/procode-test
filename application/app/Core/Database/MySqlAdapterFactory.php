<?php
/**
 * @filename: MySqlAdapterFactory.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Core\Database;

/** @uses */
use App\Core\DI\InvokableFactoryInterface;
use Interop\Container\ContainerInterface;

/**
 * Class MySqlAdapterFactory
 * @package App\Core\Database
 */
class MySqlAdapterFactory implements InvokableFactoryInterface
{
    /**
     * @param ContainerInterface $container
     *
     * @return mixed
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container['settings']['db'];
        try {
            $pdo = new \PDO(
                sprintf('mysql:host=%s;dbname=%s', $config['host'], $config['dbname']),
                $config['user'], $config['pass'], $config['options'] ?? []
            );
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

        return new MySqlAdapter($pdo);
    }
}