<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\server;


use pocketmine\Server as PMServer;
use sergittos\hythoria\packet\Packet;
use sergittos\hythoria\packet\PacketFactory;
use function count;

class Server {

    public const LOBBY = "lobby";
    public const GAME = "game";

    public const ONLINE = 1;
    public const MAINTENANCE = 2; // aka offline

    private string $id;
	private string $name;
    private string $type;

    private int $status;
    private int $players;

    public function __construct(string $id, string $name, string $type, int $players = 0, int $status = Server::ONLINE) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->players = $players;
        $this->status = $status;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getStatus(): int {
        return $this->status;
    }

    public function getPlayers(): int {
        return $this->players;
    }

    public function isOnline(): bool {
        return $this->status !== self::MAINTENANCE;
    }

    public function setStatus(int $status): void {
        $this->status = $status;
    }

    public function setPlayers(int $players): void {
        $this->players = $players;
    }

    public function updatePlayers(): void {
        $this->players = count(PMServer::getInstance()->getOnlinePlayers());
    }

    public function disconnect(): void {
        $this->players = 0;
        $this->status = self::MAINTENANCE;
    }

    public function sendPacket(Packet $packet): void {
        PacketFactory::submit($packet, $this->id);
    }

}