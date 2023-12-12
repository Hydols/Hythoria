<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\command\friend\presets;


use sergittos\hythoria\command\BaseCommand;
use sergittos\hythoria\session\Session;

class AcceptCommand extends BaseCommand {

    public function getName(): string {
        return "accept";
    }

    public function getUsage(): string {
        return "/friend accept <player>";
    }

    public function getDescription(): string {
        return "Accepts a friend request";
    }

    public function onCommand(Session $session, array $args): void {
        // TODO: Implement onCommand() method.
    }

}