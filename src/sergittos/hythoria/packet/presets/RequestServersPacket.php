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

class RequestServersPacket extends Packet { // packet sent to all redis servers, we get an UpdateServerPacket back from this

    public function pid(): int {
        return 4;
    }

    public function encodePayload(PacketSerializer $serializer): void {}

    public function decodePayload(PacketSerializer $serializer): void {}

    public function handle(): void {
        Hythoria::getInstance()->getServerManager()->sendUpdatePacket($this->sender);
    }

}