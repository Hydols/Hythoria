<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\listener;


use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\player\chat\LegacyRawChatFormatter;
use pocketmine\utils\TextFormat;
use sergittos\hythoria\session\SessionFactory;
use sergittos\hythoria\utils\ColorUtils;

class ChatListener implements Listener {

    public function onChat(PlayerChatEvent $event): void {
        $session = SessionFactory::getSession($event->getPlayer());
        if($session->hasRank()) {
            $event->setFormatter(new LegacyRawChatFormatter(ColorUtils::translate(
                $session->getRank()->getInChatName() . " {%0}{WHITE}: {%1}"
            )));
        } else {
            $event->setFormatter(new LegacyRawChatFormatter(
                TextFormat::GRAY . "{%0}: {%1}"
            ));
        }

        $event->setRecipients($session->getChannel()->getRecipients());
    }

}