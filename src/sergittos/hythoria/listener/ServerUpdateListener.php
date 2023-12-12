<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\listener;


use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use sergittos\hythoria\Hythoria;
use sergittos\hythoria\server\Server;
use function count;

class ServerUpdateListener implements Listener {

    public function onJoin(PlayerJoinEvent $event): void {
        $this->getServer()->updatePlayers();
    }

    public function onQuit(PlayerQuitEvent $event): void {
        $this->getServer()->updatePlayers();
    }

    private function getServer(): Server {
        return Hythoria::getInstance()->getServerManager()->getCurrentServer();
    }

}