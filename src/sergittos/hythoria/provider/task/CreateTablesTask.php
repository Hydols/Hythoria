<?php

declare(strict_types=1);


namespace sergittos\hythoria\provider\task;


use mysqli;

class CreateTablesTask extends MysqlAsyncTask {

    protected function onConnection(mysqli $mysqli): void {
        $mysqli->query(
            "CREATE TABLE IF NOT EXISTS users (
                xuid VARCHAR(16) PRIMARY KEY,
                rank_id TEXT DEFAULT NULL
            )"
        );
    }

}