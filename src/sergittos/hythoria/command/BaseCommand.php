<?php

declare(strict_types=1);


namespace sergittos\hythoria\command;


use sergittos\hythoria\session\Session;

abstract class BaseCommand {

    /**
     * @return string[]
     */
    public function getAliases(): array {
        return [];
    }

    /**
     * @return BaseCommand[]
     */
    public function getSubCommands(): array {
        return [];
    }

    abstract public function getName(): string;

    abstract public function getUsage(): string;

    abstract public function getDescription(): string;

    abstract public function onCommand(Session $session, array $args): void;

}