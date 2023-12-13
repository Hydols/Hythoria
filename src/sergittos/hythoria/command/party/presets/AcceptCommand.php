<?php

declare(strict_types=1);


namespace sergittos\hythoria\command\party\presets;


use sergittos\hythoria\command\BaseCommand;
use sergittos\hythoria\session\Session;

class AcceptCommand extends BaseCommand {

    public function getName(): string {
        return "accept";
    }

    public function getUsage(): string {
        return "/party accept <inviter>";
    }

    public function getDescription(): string {
        return "Accepts a party invite from the player";
    }

    public function onCommand(Session $session, array $args): void {
        // TODO: Implement onCommand() method.
    }

}