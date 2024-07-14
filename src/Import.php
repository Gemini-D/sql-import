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
use Hyperf\Database\MySqlConnection;
use Psr\Container\ContainerInterface;

class Import
{
    protected ConnectionFactory $factory;

    public function __construct(protected ContainerInterface $container)
    {
        $this->factory = $this->container->get(ConnectionFactory::class);
    }

    public function load(array $config, string $sql): Result
    {
        /** @var MySqlConnection $connection */
        $connection = $this->factory->make($config);

        $res = $connection->getPdo()->exec($sql);
        if ($res === false) {
            return new Result(false);
        }

        return new Result(true);
    }
}
