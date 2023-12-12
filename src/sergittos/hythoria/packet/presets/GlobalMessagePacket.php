<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\packet\presets;


use pocketmine\Server;
use raklib\protocol\PacketSerializer;
use sergittos\hythoria\packet\Packet;
use sergittos\hythoria\utils\ColorUtils;

class GlobalMessagePacket extends Packet { // used for testing

    public string $message;

    public function pid(): int {
        return 10;
    }

    protected function encodePayload(PacketSerializer $serializer): void {
        $serializer->putString($this->message);
    }

    protected function decodePayload(PacketSerializer $serializer): void {
        $this->message = $serializer->getString();
    }

    public function handle(): void {
        Server::getInstance()->broadcastMessage(ColorUtils::translate($this->message));
    }

}