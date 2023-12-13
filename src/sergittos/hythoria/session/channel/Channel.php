<?php

declare(strict_types=1);


namespace sergittos\hythoria\session\channel;


use pocketmine\player\Player;

abstract class Channel {

    abstract public function getName(): string;

    /**
     * @return Player[]
     */
    abstract public function getRecipients(): array;

}