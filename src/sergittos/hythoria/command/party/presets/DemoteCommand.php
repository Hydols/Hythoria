<?php

declare(strict_types=1);


namespace sergittos\hythoria\command\party\presets;


use sergittos\hythoria\command\BaseCommand;
use sergittos\hythoria\session\Session;

class DemoteCommand extends BaseCommand {

    public function getName(): string {
        return "demote";
    }

    public function getUsage(): string {
        return "/party demote <player>";
    }

    public function getDescription(): string {
        return "Demotes a party moderator to a party member";
    }

    public function onCommand(Session $session, array $args): void {
        // TODO: Implement onCommand() method.
    }

}