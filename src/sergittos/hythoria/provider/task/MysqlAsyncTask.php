<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\provider\task;


use mysqli;
use pocketmine\scheduler\AsyncTask;
use sergittos\hythoria\Hythoria;
use sergittos\hythoria\provider\MysqlProvider;
use function serialize;
use function unserialize;

abstract class MysqlAsyncTask extends AsyncTask {

    private string $credentials;

    public function __construct(?MysqlProvider $provider = null) {
        $this->credentials = serialize(($provider ?? Hythoria::getInstance()->getProvider())->getCredentials());
    }

    public function onRun(): void {
        $mysqli = unserialize($this->credentials)->getMysqli();
        $this->onConnection($mysqli);
        $mysqli->close();
    }

    abstract protected function onConnection(mysqli $mysqli): void;

}