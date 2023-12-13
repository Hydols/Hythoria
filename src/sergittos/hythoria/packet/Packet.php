<?php

declare(strict_types=1);


namespace sergittos\hythoria\packet;


use raklib\protocol\PacketSerializer;

abstract class Packet {

    public string $target;
    public string $sender;

	abstract public function pid(): int;

    public function encode(PacketSerializer $serializer): void {
        $serializer->putString($this->target);
        $serializer->putString($this->sender);
        $this->encodePayload($serializer);
    }

    abstract protected function encodePayload(PacketSerializer $serializer): void;

    public function decode(PacketSerializer $serializer): void {
        $this->target = $serializer->getString();
        $this->sender = $serializer->getString();
        $this->decodePayload($serializer);
    }

	abstract protected function decodePayload(PacketSerializer $serializer): void;

	abstract public function handle(): void;

}