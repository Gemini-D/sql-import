# SQL导入组件

```
composer create-project gemini/sql-import
```

## 使用

```php
<?php

use Fan\SqlImport\Import;

$res = di()->get(Import::class)->load(
    [
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => 3306,
        'database' => 'test',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
    ],
    file_get_contents(BASE_PATH . '/storage/sql/xxx.sql')
);
```
