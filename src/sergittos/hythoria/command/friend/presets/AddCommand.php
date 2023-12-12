<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\command\friend\presets;


use pocketmine\Server;
use sergittos\hythoria\command\BaseCommand;
use sergittos\hythoria\session\friend\FriendRequest;
use sergittos\hythoria\session\Session;
use sergittos\hythoria\session\SessionFactory;
use function strtolower;

class AddCommand extends BaseCommand {

    public function getName(): string {
        return "add";
    }

    public function getUsage(): string {
        return "/friend add <player>";
    }

    public function getDescription(): string {
        return "Adds a player as friend";
    }

    public function onCommand(Session $session, array $args): void {
        if(!isset($args[0])) {
            $session->message("{RED}Usage: " . $this->getUsage());
            return;
        }

        $username = strtolower($args[0]);
        $player = Server::getInstance()->getPlayerExact($username);
        if($player === null) {
            $session->message("{RED}You can't add offline players as friend!");
            return;
        } elseif($session->getUsername() === $username) {
            $session->message("{RED}You can't add yourself as friend!");
            return;
        } elseif($session->hasFriend($player->getXuid())) {
            $session->message("{RED}The player you want to add as friend is already your friend!");
            return;
        }

        $target_session = SessionFactory::getSession($player);
        if(!$target_session->acceptFriendRequests()) {
            $session->message("{RED}" . $args[0] . " doesn't accept friend requests!");
            return;
        } elseif($target_session->hasFriendRequest($username)) {
            $session->message("{RED}" . $args[0] . " already has a friend request pending for you!");
            return;
        }

        $target_session->addFriendRequest(new FriendRequest($session, $target_session));
        $session->message("{GREEN}You've sent a friend request to " . $args[0] . " successfully.");
    }

}