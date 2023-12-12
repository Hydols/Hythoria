<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\listener;


use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use sergittos\hythoria\item\HythoriaItems;
use sergittos\hythoria\session\SessionFactory;

class ItemListener implements Listener {

    public function onTransaction(InventoryTransactionEvent $event): void {
        foreach($event->getTransaction()->getActions() as $action) {
            if($action->getSourceItem()->getNamedTag()->getTag("hythoria") !== null) {
                $event->cancel();
            }
        }
    }

    public function onItemUse(PlayerItemUseEvent $event): void {
        $tag = $event->getItem()->getNamedTag()->getTag("hythoria");
        if($tag === null) {
            return;
        }

        HythoriaItems::get(strtolower($tag->getValue()))->onInteract(SessionFactory::getSession($event->getPlayer())); // TODO: Clean
    }

}