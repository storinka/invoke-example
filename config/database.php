<?php

use Cycle\Database\Config\SQLite\FileConnectionConfig;
use Cycle\Database\Config\SQLiteDriverConfig;

return [
    "default" => "default",
    "databases" => [
        "default" => ["connection" => "sqlite"]
    ],
    "connections" => [
        "sqlite" => new SQLiteDriverConfig(
            connection: new FileConnectionConfig("database.db"),
            queryCache: true,
        ),
    ]
];