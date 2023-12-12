<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\packet\presets;


use raklib\protocol\PacketSerializer;
use sergittos\hythoria\Hythoria;
use sergittos\hythoria\packet\Packet;
use sergittos\hythoria\server\Server;

class UpdateServerPacket extends Packet {

    public string $id;
    public string $name;
    public string $type;

    public int $status;
    public int $players;

    public function pid(): int {
		return 1;
	}

    protected function encodePayload(PacketSerializer $serializer): void {
        $serializer->putString($this->id);
        $serializer->putString($this->name);
        $serializer->putString($this->type);
        $serializer->putInt($this->status);
        $serializer->putInt($this->players);
    }

    protected function decodePayload(PacketSerializer $serializer): void {
        $this->id = $serializer->getString();
		$this->name = $serializer->getString();
        $this->type = $serializer->getString();
        $this->status = $serializer->getInt();
		$this->players = $serializer->getInt();
	}

	public function handle(): void {
        $server_manager = Hythoria::getInstance()->getServerManager();

		$server = $server_manager->getServer($this->id);
		if($server === null) {
            $server_manager->addServer(new Server($this->id, $this->name, $this->type, $this->players, $this->status));
			return;
		}

		$server->setPlayers($this->players);
        $server->setStatus($this->status);
        $server_manager->onServerUpdated($server);
	}

    public function setServer(Server $server): void {
        $this->id = $server->getId();
        $this->name = $server->getName();
        $this->type = $server->getType();
        $this->status = $server->getStatus();
        $this->players = $server->getPlayers();
    }

}