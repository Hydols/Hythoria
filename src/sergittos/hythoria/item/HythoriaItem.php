<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\item;


use pocketmine\item\Item;
use pocketmine\utils\TextFormat;
use sergittos\hythoria\session\Session;

abstract class HythoriaItem {

    private string $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function asItem(): Item {
        $item = $this->realItem();
        $item->setCustomName(TextFormat::GREEN . $this->name);
        $item->getNamedTag()->setString("hythoria", str_replace(" ", "_", TextFormat::clean($this->name)));
        return $item;
    }

    abstract public function onInteract(Session $session): void;

    abstract protected function realItem(): Item;

}