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

namespace HyperfTest\Cases;

use Fan\SqlImport\Importer;
use Fan\SqlImport\Privilege;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Database\Connectors\ConnectionFactory;
use Hyperf\Database\Connectors\MySqlConnector;
use Hyperf\DbConnection\Frequency;
use Mockery;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * @internal
 * @coversNothing
 */
class ImportTest extends TestCase
{
    public function testLoadConfig()
    {
        $config = [
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'port' => 3306,
            'database' => 'test',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
        ];

        $import = new Importer($this->getContainer());
        $res = $import->import($config, file_get_contents(__DIR__ . '/../sql/init.sql'));
        $this->assertTrue($res->isSuccess);

        $res = $import->import($config, file_get_contents(__DIR__ . '/../sql/init.sql'), false);
        $this->assertTrue($res->isSuccess);
    }

    public function testLoadPath()
    {
        $config = [
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'port' => 3306,
            'database' => 'test',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
        ];

        $import = new Importer($this->getContainer());
        $res = $import->importPath($config, __DIR__ . '/../sql/init.sql');
        $this->assertTrue($res->isSuccess);

        $res = $import->importPath($config, __DIR__ . '/../sql/init.sql', true);
        $this->assertTrue($res->isSuccess);
    }

    public function testPrivilegeCreateUser()
    {
        $config = [
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'port' => 3306,
            'database' => 'test',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
        ];

        $pri = new Privilege($this->getContainer());
        $res = $pri->createUser('test', '%', '', $config);
        $this->assertTrue($res);

        $res = $pri->grant('test', '%', '*', '*', $config);
        $this->assertTrue($res);
    }

    public function getContainer()
    {
        $container = Mockery::mock(ContainerInterface::class);
        $container->shouldReceive('get')->with(ConnectionFactory::class)->andReturn(new ConnectionFactory($container));
        $container->shouldReceive('get')->with('db.connector.mysql')->andReturn(new MySqlConnector());
        $container->shouldReceive('has')->andReturn(true);
        $container->shouldReceive('has')->with(StdoutLoggerInterface::class)->andReturnFalse();
        $container->shouldReceive('has')->with(EventDispatcherInterface::class)->andReturnFalse();
        $container->shouldReceive('make')->with(Frequency::class)->andReturn(new Frequency());
        return $container;
    }
}
