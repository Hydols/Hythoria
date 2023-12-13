<?php

declare(strict_types=1);


namespace sergittos\hythoria\command\party\presets;


use sergittos\hythoria\command\BaseCommand;
use sergittos\hythoria\session\Session;

class KickCommand extends BaseCommand {

    public function getName(): string {
        return "kick";
    }

    public function getUsage(): string {
        return "/party kick <player>";
    }

    public function getDescription(): string {
        return "Remove a player from your party";
    }

    public function onCommand(Session $session, array $args): void {
        // TODO: Implement onCommand() method.
    }

}