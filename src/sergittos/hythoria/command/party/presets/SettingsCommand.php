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

class SettingsCommand extends BaseCommand {

    public function getName(): string {
        return "settings";
    }

    public function getUsage(): string {
        return "/party settings <setting> <value>";
    }

    public function getDescription(): string {
        return "Toggles party settings";
    }

    public function onCommand(Session $session, array $args): void {
        // TODO: Implement onCommand() method.
    }

}