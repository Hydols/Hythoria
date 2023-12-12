<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\command\party\presets;


use sergittos\hythoria\command\BaseCommand;
use sergittos\hythoria\session\Session;

class PromoteCommand extends BaseCommand {

    public function getName(): string {
        return "promote";
    }

    public function getUsage(): string {
        return "/party promote <player>";
    }

    public function getDescription(): string {
        return "Promotes another party member to either Party Mod or Party Leader";
    }

    public function onCommand(Session $session, array $args): void {
        // TODO: Implement onCommand() method.
    }

}