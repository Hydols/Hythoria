<?php

declare(strict_types=1);


namespace sergittos\hythoria\command\party\presets;


use sergittos\hythoria\command\BaseCommand;
use sergittos\hythoria\session\Session;

class DisbandCommand extends BaseCommand {

    public function getName(): string {
        return "disband";
    }

    public function getUsage(): string {
        return "/party disband";
    }

    public function getDescription(): string {
        return "Disbands the party";
    }

    public function onCommand(Session $session, array $args): void {
        // TODO: Implement onCommand() method.
    }

}