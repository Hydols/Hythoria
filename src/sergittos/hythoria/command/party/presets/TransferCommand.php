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

class TransferCommand extends BaseCommand {

    public function getName(): string {
        return "transfer";
    }

    public function getUsage(): string {
        return "/party transfer <player>";
    }

    public function getDescription(): string {
        return "Transfers the party to another player";
    }

    public function onCommand(Session $session, array $args): void {
        // TODO: Implement onCommand() method.
    }

}