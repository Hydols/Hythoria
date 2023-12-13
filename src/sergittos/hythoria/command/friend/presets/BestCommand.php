<?php

declare(strict_types=1);


namespace sergittos\hythoria\command\friend\presets;


use sergittos\hythoria\command\BaseCommand;
use sergittos\hythoria\session\Session;

class BestCommand extends BaseCommand {

    public function getName(): string {
        return "best";
    }

    public function getUsage(): string {
        return "/friend best <player>";
    }

    public function getDescription(): string {
        return "Toggles a player as best friend";
    }

    public function onCommand(Session $session, array $args): void {
        // TODO: Implement onCommand() method.
    }

}