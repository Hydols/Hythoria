<?php

declare(strict_types=1);


namespace sergittos\hythoria\packet\presets;


use raklib\protocol\PacketSerializer;
use sergittos\hythoria\packet\Packet;
use sergittos\hythoria\party\Party;

class PartyTransferPacket extends Packet {

    public Party $party;

    public function pid(): int {
        return 2;
    }

    protected function encodePayload(PacketSerializer $serializer): void {

    }

    protected function decodePayload(PacketSerializer $serializer): void {
        $this->party = new Party(
            ""
        );
    }

    public function handle(): void {
        // TODO: Implement handle() method.
    }

}