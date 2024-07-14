<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace Fan\SqlImport;

use Hyperf\Database\Connectors\ConnectionFactory;
use Psr\Container\ContainerInterface;

class Privilege
{
    protected ConnectionFactory $factory;

    public function __construct(protected ContainerInterface $container)
    {
        $this->factory = $this->container->get(ConnectionFactory::class);
    }

    public function createUser(string $name, string $host, string $password, array $config): bool
    {
        $pdo = $this->factory->make($config)->getPdo();

        $sql = sprintf("CREATE USER '%s'@'%s' IDENTIFIED BY '%s';", $name, $host, $password);

        if ($pdo->exec($sql) !== false) {
            $pdo->exec('FLUSH PRIVILEGES;');
            return true;
        }

        return false;
    }

    public function grant(string $name, string $host, string $database, string $table, array $config): bool
    {
        $pdo = $this->factory->make($config)->getPdo();

        $sql = sprintf("GRANT ALL PRIVILEGES ON %s.%s TO '%s'@'%s';", $database, $table, $name, $host);

        if ($pdo->exec($sql) !== false) {
            $pdo->exec('FLUSH PRIVILEGES;');
            return true;
        }

        return false;
    }
}
