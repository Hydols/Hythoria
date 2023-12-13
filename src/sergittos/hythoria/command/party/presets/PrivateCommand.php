<?php

declare(strict_types=1);


namespace sergittos\hythoria\command\party\presets;


use sergittos\hythoria\command\BaseCommand;
use sergittos\hythoria\session\Session;

class PrivateCommand extends BaseCommand {

    public function getName(): string {
        return "private";
    }

    public function getUsage(): string {
        return "/party private";
    }

    public function getDescription(): string {
        return "Enables private games for your party";
    }

    public function onCommand(Session $session, array $args): void {
        // TODO: Implement onCommand() method.
    }

}