<?php

declare(strict_types=1);


namespace sergittos\hythoria\command\party\presets;


use sergittos\hythoria\command\BaseCommand;
use sergittos\hythoria\session\Session;

class KickofflineCommand extends BaseCommand {

    public function getName(): string {
        return "kickoffline";
    }

    public function getUsage(): string {
        return "/party kickoffline";
    }

    public function getDescription(): string {
        return "Remove all players that are offline in your party";
    }

    public function onCommand(Session $session, array $args): void {
        // TODO: Implement onCommand() method.
    }

}