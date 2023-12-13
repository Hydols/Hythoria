<?php

declare(strict_types=1);


namespace sergittos\hythoria\command\friend\presets;


use sergittos\hythoria\command\BaseCommand;
use sergittos\hythoria\session\Session;

class RemoveCommand extends BaseCommand {

    public function getName(): string {
        return "remove";
    }

    public function getUsage(): string {
        return "/friend remove <player>";
    }

    public function getDescription(): string {
        return "Removes a player from your friends list";
    }

    public function onCommand(Session $session, array $args): void {
        // TODO: Implement onCommand() method.
    }

}