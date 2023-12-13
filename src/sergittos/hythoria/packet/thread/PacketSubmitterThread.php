<?php

declare(strict_types=1);


namespace sergittos\hythoria\packet\thread;


use pmmp\thread\ThreadSafeArray;
use pocketmine\thread\Thread;
use Predis\Client;
use raklib\protocol\PacketSerializer;
use sergittos\hythoria\packet\Packet;
use function dirname;

class PacketSubmitterThread extends Thread {

    private ThreadSafeArray $mainToThread;
    private string $autoloaderPath;

    public function __construct() {
        $this->mainToThread = new ThreadSafeArray();
        $this->autoloaderPath = dirname(__DIR__) . "/../../../../vendor/autoload.php"; // TODO: Fix this
    }

    protected function onRun(): void {
        require $this->autoloaderPath;

        $redis = new Client(); // default is localhost

        while (($payload = $this->mainToThread->shift()) !== null) {
            $redis->publish("servers", $payload);
        }
    }

    public function submit(Packet $packet): void {
        $serializer = new PacketSerializer();
        $serializer->putUnsignedVarInt($packet->pid());

        $packet->encode($serializer);

        $this->mainToThread[] = $serializer->getBuffer();
    }

}