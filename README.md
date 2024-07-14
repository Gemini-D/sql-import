# SQL导入组件

```
composer create-project gemini/sql-import
```

## 使用

```php
<?php

use Fan\SqlImport\Importer;

$res = di()->get(Importer::class)->import(
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

### 创建用户

```php
<?php

use Fan\SqlImport\Importer;

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

$res = di()->get(Privilege::class)->createUser('test', '%', '', $config);
$res = di()->get(Privilege::class)->grant('test', '%', '*', '*', $config);
```
