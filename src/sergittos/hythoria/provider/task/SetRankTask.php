<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\provider\task;


use mysqli;
use sergittos\hythoria\rank\Rank;
use sergittos\hythoria\session\Session;

class SetRankTask extends MysqlAsyncTask {

    private string $xuid;
    private ?string $rank_id;

    public function __construct(Session $session, ?Rank $rank) {
        $this->xuid = $session->getXuid();
        $this->rank_id = $rank?->getId();
        parent::__construct();
    }

    protected function onConnection(mysqli $mysqli): void {
        $stmt = $mysqli->prepare("UPDATE users SET rank_id = ? WHERE xuid = ?");
        $stmt->bind_param("ss", ...[$this->rank_id, $this->xuid]);
        $stmt->execute();
        $stmt->close();
    }

}