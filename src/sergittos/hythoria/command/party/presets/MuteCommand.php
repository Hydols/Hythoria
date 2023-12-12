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

class MuteCommand extends BaseCommand {

    public function getName(): string {
        return "mute";
    }

    public function getUsage(): string {
        return "/party mute";
    }

    public function getDescription(): string {
        return "Mutes party so only Staff, Party Mods and the Leader can use it";
    }

    public function onCommand(Session $session, array $args): void {
        // TODO: Implement onCommand() method.
    }

}