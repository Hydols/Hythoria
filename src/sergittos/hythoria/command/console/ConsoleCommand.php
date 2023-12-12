<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\command\console;


use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\permission\DefaultPermissions;

abstract class ConsoleCommand extends Command {

    public function __construct(string $name) {
        $this->setPermission(DefaultPermissions::ROOT_CONSOLE);
        parent::__construct($name);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if($this->testPermission($sender) and $sender instanceof ConsoleCommandSender) {
            $this->onCommand($sender, $args);
        }
    }

    abstract protected function onCommand(ConsoleCommandSender $sender, array $args): void;

}