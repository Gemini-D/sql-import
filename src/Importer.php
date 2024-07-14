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

use Fan\SqlImport\Exception\NotFoundException;
use Hyperf\Database\Connectors\ConnectionFactory;
use Psr\Container\ContainerInterface;
use Throwable;

class Importer
{
    protected ConnectionFactory $factory;

    public function __construct(protected ContainerInterface $container)
    {
        $this->factory = $this->container->get(ConnectionFactory::class);
    }

    public function import(array $config, string $sql): Result
    {
        $connection = $this->factory->make($config);

        $res = $connection->getPdo()->exec($sql);
        if ($res === false) {
            return new Result(false);
        }

        return new Result(true);
    }

    public function importPath(array $config, string $path): Result
    {
        // if file cannot be found throw errror
        if (! file_exists($path)) {
            throw new NotFoundException(sprintf('File %s not found.', $path));
        }

        $pdo = $this->factory->make($config)->getPdo();
        $fp = fopen($path, 'r');
        $sql = '';
        $result = new Result(true);
        while (($line = fgets($fp)) !== false) {
            try {
                if (str_starts_with($line, '--') || $line == '') {
                    continue;
                }

                // Add this line to the current segment
                $sql .= $line;

                // If it has a semicolon at the end, it's the end of the query
                if (str_ends_with(trim($line), ';')) {
                    $pdo->exec($sql);
                    $sql = '';
                }
            } catch (Throwable $exception) {
                $result->failedSqls[] = new FailedSql($sql, $exception->getMessage());
                $sql = '';
            }
        }

        fclose($fp);
        return $result;
    }
}
