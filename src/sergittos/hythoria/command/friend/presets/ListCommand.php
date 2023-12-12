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

class ListCommand extends BaseCommand {

    public function getName(): string {
        return "list";
    }

    public function getUsage(): string {
        return "/friend list <page/best>";
    }

    public function getDescription(): string {
        return "Shows friends list";
    }

    public function onCommand(Session $session, array $args): void {
        // TODO: Implement onCommand() method.
    }

}