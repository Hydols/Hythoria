<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\provider;


use mysqli;
use pocketmine\Server;
use sergittos\hythoria\Hythoria;
use sergittos\hythoria\provider\task\CreateTablesTask;
use sergittos\hythoria\provider\task\LoadSessionTask;
use sergittos\hythoria\provider\task\MysqlAsyncTask;
use sergittos\hythoria\provider\task\SetRankTask;
use sergittos\hythoria\rank\Rank;
use sergittos\hythoria\session\Session;

class MysqlProvider {

    private MysqlCredentials $credentials;

    public function __construct() {
        $this->credentials = MysqlCredentials::fromData(Hythoria::getInstance()->getConfig()->get("mysql-credentials"));

        $this->submitTask(new CreateTablesTask($this));
    }

    public function getCredentials(): MysqlCredentials {
        return $this->credentials;
    }

    public function loadSession(Session $session): void {
        $this->submitTask(new LoadSessionTask($session));
    }

    public function setRank(Session $session, ?Rank $rank): void {
        $this->submitTask(new SetRankTask($session, $rank));
    }

    private function submitTask(MysqlAsyncTask $task): void {
        Server::getInstance()->getAsyncPool()->submitTask($task);
    }

}