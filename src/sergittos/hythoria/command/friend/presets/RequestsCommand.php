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

class RequestsCommand extends BaseCommand {

    public function getName(): string {
        return "requests";
    }

    public function getUsage(): string {
        return "/friend requests <page>";
    }

    public function getDescription(): string {
        return "View friend requests";
    }

    public function onCommand(Session $session, array $args): void {
        // TODO: Implement onCommand() method.
    }

}