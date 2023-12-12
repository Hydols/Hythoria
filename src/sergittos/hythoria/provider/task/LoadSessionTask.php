<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\provider\task;


use mysqli;
use sergittos\hythoria\Hythoria;
use sergittos\hythoria\session\Session;
use sergittos\hythoria\session\SessionFactory;

class LoadSessionTask extends MysqlAsyncTask {

    private string $username;
    private string $xuid;

    public function __construct(Session $session) {
        $this->username = $session->getUsername();
        $this->xuid = $session->getXuid();
        parent::__construct();
    }

    protected function onConnection(mysqli $mysqli): void {
        $statement = $mysqli->prepare("SELECT * FROM users WHERE xuid = ?");
        $statement->bind_param("s", ...[$this->xuid]);
        $statement->execute();

        $result = $statement->get_result();
        if($result === false) {
            echo $statement->error;
            return;
        }

        $result = $result->fetch_assoc();

        $statement->free_result();
        $statement->close();

        if(empty($result)) {
            $statement = $mysqli->prepare("INSERT INTO users (xuid) VALUES (?)");
            $statement->bind_param("s", ...[$this->xuid]);
            $statement->execute();
        }

        $this->setResult($result);
    }

    public function onCompletion(): void {
        $session = SessionFactory::getSessionByName($this->username);
        if($session === null) {
            return;
        }

        $result = $this->getResult();
        if(empty($result)) {
            return;
        }

        $rank_id = $result["rank_id"];
        if($rank_id !== null) {
            $session->setRank(Hythoria::getInstance()->getRankManager()->getRank($rank_id));
        }
    }

}