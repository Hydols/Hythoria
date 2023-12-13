<?php

declare(strict_types=1);


namespace sergittos\hythoria\packet;


use pmmp\thread\Thread;
use pmmp\thread\ThreadSafeArray;
use pocketmine\network\mcpe\raklib\PthreadsChannelReader;
use pocketmine\Server;
use raklib\protocol\PacketSerializer;
use sergittos\hythoria\Hythoria;
use sergittos\hythoria\packet\presets\GlobalMessagePacket;
use sergittos\hythoria\packet\presets\PartyTransferPacket;
use sergittos\hythoria\packet\presets\RequestServersPacket;
use sergittos\hythoria\packet\presets\UpdateServerPacket;
use sergittos\hythoria\packet\thread\PacketHandlerThread;
use sergittos\hythoria\packet\thread\PacketSubmitterThread;

class PacketFactory {

    static private PacketHandlerThread $handler;
    static private PacketSubmitterThread $submitter;

	/** @var Packet[] */
	static private array $packets = [];

	static public function init(): void {
		self::registerPacket(new UpdateServerPacket());
        self::registerPacket(new PartyTransferPacket());
        self::registerPacket(new GlobalMessagePacket());
        self::registerPacket(new RequestServersPacket());

        self::startThreads();
	}

	/**
	 * @return Packet[]
	 */
	public static function getPackets(): array {
		return self::$packets;
	}

    static public function getPacket(int $id): ?Packet {
        return self::$packets[$id] ?? null;
    }

    static public function submit(Packet $packet, string $target): void {
        $packet->target = $target;
        $packet->sender = Hythoria::getInstance()->getServerManager()->getCurrentServer()->getId();

        self::$submitter->submit($packet);
    }

    static private function onPacketReceive(string $payload): void {
        $serializer = new PacketSerializer($payload);

        $packet = self::getPacket($serializer->getUnsignedVarInt());
        $packet->decode($serializer);

        $target = $packet->target;

        $id = Hythoria::getInstance()->getServerManager()->getCurrentServer()->getId();
        if($id !== $packet->sender and ($target === "all" or $id === $target)) {
            $packet->handle();
        }
    }

	static private function registerPacket(Packet $packet): void {
		self::$packets[$packet->pid()] = clone $packet;
	}

    static private function startThreads(): void {
        $threadToMainBuffer = new ThreadSafeArray();
        $threadToMainReader = new PthreadsChannelReader($threadToMainBuffer);

        $sleeper = Server::getInstance()->getTickSleeper()->addNotifier(function() use ($threadToMainReader) {
            while(($payload = $threadToMainReader->read()) !== null) {
                self::onPacketReceive($payload);
            }
        });

        self::$handler = new PacketHandlerThread($threadToMainBuffer, $sleeper);
        self::$handler->start(Thread::INHERIT_CONSTANTS);

        self::$submitter = new PacketSubmitterThread();
        self::$submitter->start(Thread::INHERIT_CONSTANTS);
    }

}