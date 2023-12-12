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
use sergittos\hythoria\session\SessionFactory;

class TransferSessionPacket extends Packet {

    public string $username;

    public function pid(): int {
        return 3;
    }

    protected function encodePayload(PacketSerializer $serializer): void {
        $serializer->putString($this->username);
    }

    protected function decodePayload(PacketSerializer $serializer): void {
        $this->username = $serializer->getString();
    }

    public function handle(): void {
        SessionFactory::getSessionByName($this->username)?->transferTo(
            Hythoria::getInstance()->getServerManager()->getServer($this->target)
        );
    }

}