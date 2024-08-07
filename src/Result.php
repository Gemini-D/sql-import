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

class Result
{
    /**
     * @param FailedSql[] $failedSqls
     */
    public function __construct(public bool $isSuccess, public array $failedSqls = [])
    {
    }
}
