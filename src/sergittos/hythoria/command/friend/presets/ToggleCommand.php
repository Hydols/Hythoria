<?php

declare(strict_types=1);


namespace sergittos\hythoria\command\friend\presets;


use sergittos\hythoria\command\BaseCommand;
use sergittos\hythoria\session\Session;

class ToggleCommand extends BaseCommand {

    public function getName(): string {
        return "toggle";
    }

    public function getUsage(): string {
        return "/friend toggle";
    }

    public function getDescription(): string {
        return "Toggles the friend requests";
    }

    public function onCommand(Session $session, array $args): void {
        if(!$session->acceptFriendRequests()) {
            $session->setAcceptFriendRequests(true);
            $session->message("{GREEN}You now accept friend requests!");
        } else {
            $session->setAcceptFriendRequests(false);
            $session->message("{GREEN}You now don't accept friend requests");
        }
    }

}