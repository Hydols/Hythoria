<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\server;


use pocketmine\Server as PMServer;
use pocketmine\utils\Config;
use sergittos\hythoria\entity\PlayGameEntity;
use sergittos\hythoria\Hythoria;
use sergittos\hythoria\packet\PacketFactory;
use sergittos\hythoria\packet\presets\RequestServersPacket;
use sergittos\hythoria\packet\presets\UpdateServerPacket;
use sergittos\hythoria\session\SessionFactory;
use function array_key_first;

class ServerManager {

    /** @var Server[] */
    private array $servers = [];

    public function __construct() {
        $config = new Config(Hythoria::getInstance()->getDataFolder() . "server.json");
        $this->addServer(new Server($config->get("id"), $config->get("name"), $config->get("type")));
    }

    /**
     * @return Server[]
     */
    public function getServers(): array {
        return $this->servers;
    }

    /**
     * @return Server[]
     */
    public function getServersByType(string $type): array {
        $servers = [];
        foreach($this->servers as $server) {
            if($server->getType() === $type) {
                $servers[] = $server;
            }
        }
        return $servers;
    }

    public function getServer(string $id): ?Server {
        return $this->servers[$id] ?? null;
    }

    public function getServerByName(string $name): ?Server {
        foreach($this->servers as $server) {
            if($server->getName() === $name) {
                return $server;
            }
        }
        return null;
    }

    public function getCurrentServer(): Server {
        return $this->servers[array_key_first($this->servers)];
    }

    public function getOnlinePlayers(): int {
        $players = 0;
        foreach($this->servers as $server) {
            $players += $server->getPlayers();
        }
        return $players;
    }

    public function addServer(Server $server): void {
        $this->servers[$server->getId()] = $server;
    }

    public function removeServer(string $id): void {
        unset($this->servers[$id]);
    }

    public function submitInitialPackets(): void {
        PacketFactory::submit(new RequestServersPacket(), "all");
        $this->sendUpdatePacket("all");
    }

    public function sendUpdatePacket(string $target): void {
        $packet = new UpdateServerPacket();
        $packet->setServer($this->getCurrentServer());

        PacketFactory::submit($packet, $target);
    }

    public function onServerUpdated(Server $server): void {
        foreach(PMServer::getInstance()->getWorldManager()->getWorlds() as $world) {
            foreach($world->getEntities() as $entity) {
                if($entity instanceof PlayGameEntity and $entity->getGame()->getId() === $server->getId()) {
                    $entity->updateNameTag();
                }
            }
        }

        foreach(SessionFactory::getSessions() as $session) {
            $session->updateScoreboard();
        }

        // update scorebaords, forms, etc.
    }

}