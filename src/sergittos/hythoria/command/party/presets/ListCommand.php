<?php

declare(strict_types=1);


namespace sergittos\hythoria\command\party\presets;


use sergittos\hythoria\command\BaseCommand;
use sergittos\hythoria\session\Session;

class ListCommand extends BaseCommand {

    public function getName(): string {
        return "list";
    }

    public function getUsage(): string {
        return "/party list";
    }

    public function getDescription(): string {
        return "Lists the players in your current party";
    }

    public function onCommand(Session $session, array $args): void {
        // TODO: Implement onCommand() method.
    }

}