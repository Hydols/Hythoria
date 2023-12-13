<?php

declare(strict_types=1);


namespace sergittos\hythoria\command\party\presets;


use sergittos\hythoria\command\BaseCommand;
use sergittos\hythoria\session\Session;

class PollCommand extends BaseCommand {

    public function getName(): string {
        return "poll";
    }

    public function getUsage(): string {
        return "/party poll <question/answer/answer/answer...>";
    }

    public function getDescription(): string {
        return "Creates a poll for party members to vote on";
    }

    public function onCommand(Session $session, array $args): void {
        // TODO: Implement onCommand() method.
    }

}