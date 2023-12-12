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

class NotificationsCommand extends BaseCommand {

    public function getName(): string {
        return "notifications";
    }

    public function getUsage(): string {
        return "/friend notifications";
    }

    public function getDescription(): string {
        return "Toggle friend join/leave notifications";
    }

    public function onCommand(Session $session, array $args): void {
        // TODO: Implement onCommand() method.
    }

}