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

class RemoveAllCommand extends BaseCommand {

    public function getName(): string {
        return "removeall";
    }

    public function getUsage(): string {
        return "/friend removeall";
    }

    public function getDescription(): string {
        return "Removes all your friends";
    }

    public function onCommand(Session $session, array $args): void {
        // TODO: Implement onCommand() method.
    }

}