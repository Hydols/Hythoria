<?php

declare(strict_types=1);


namespace sergittos\hythoria\listener;


use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\utils\TextFormat;
use sergittos\hythoria\session\SessionFactory;

class SessionListener implements Listener {

    public function onLogin(PlayerLoginEvent $event): void {
        SessionFactory::createSession($event->getPlayer());
    }

    public function onJoin(PlayerJoinEvent $event): void {
        $session = SessionFactory::getSession($event->getPlayer());
        $session->teleportToLobby();

        if($session->hasRank()) {
            $event->setJoinMessage(
                $session->getRank()->getInChatName() . " " . $session->getUsername() . TextFormat::GOLD . " joined the lobby!"
            );
        } else {
            $event->setJoinMessage("");
        }
    }

    /**
     * @priority HIGHEST
     */
    public function onQuit(PlayerQuitEvent $event): void {
        SessionFactory::removeSession($event->getPlayer());
        $event->setQuitMessage("");
    }

}