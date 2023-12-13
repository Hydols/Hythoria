<?php

declare(strict_types=1);


namespace sergittos\hythoria\packet\thread;


use pmmp\thread\ThreadSafeArray;
use pocketmine\snooze\SleeperHandlerEntry;
use pocketmine\snooze\SleeperNotifier;
use pocketmine\thread\Thread;
use Predis\Client;
use Predis\PubSub\AbstractConsumer;
use function dirname;

class PacketHandlerThread extends Thread {

    private ThreadSafeArray $threadToMainBuffer;
    private SleeperHandlerEntry $sleeperHandler;

    private string $autoloaderPath;

    public function __construct(ThreadSafeArray $threadToMainBuffer, SleeperHandlerEntry $sleeperHandler) {
        $this->threadToMainBuffer = $threadToMainBuffer;
        $this->sleeperHandler = $sleeperHandler;
        $this->autoloaderPath = dirname(__DIR__) . "/../../../../vendor/autoload.php"; // TODO: Fix this
    }

    protected function onRun(): void {
        require $this->autoloaderPath;

        $redis = new Client(); // default is localhost

        $notifier = $this->sleeperHandler->createNotifier();

        $pubSubLoop = $redis->pubSubLoop();
        $pubSubLoop->subscribe("servers");

        foreach($pubSubLoop as $message) {
            if($message->kind === AbstractConsumer::MESSAGE) {
                $this->writePayload($message->payload, $notifier);
            }
        }

        unset($pubSubLoop);
    }

    private function writePayload(string $payload, SleeperNotifier $notifier): void {
        $this->threadToMainBuffer[] = $payload;
        $notifier->wakeupSleeper();
    }

}