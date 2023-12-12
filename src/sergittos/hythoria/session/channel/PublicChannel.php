<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\session\channel;


use pocketmine\Server;

class PublicChannel extends Channel {

    public function getName(): string {
        return "all";
    }

    public function getRecipients(): array {
        return Server::getInstance()->getOnlinePlayers();
    }

}