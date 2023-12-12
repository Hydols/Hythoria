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

class WarpCommand extends BaseCommand {

    public function getName(): string {
        return "warp";
    }

    public function getUsage(): string {
        return "/party warp";
    }

    public function getDescription(): string {
        return "Warps the members of a party to your current server";
    }

    public function onCommand(Session $session, array $args): void {
        // TODO: Implement onCommand() method.
    }

}