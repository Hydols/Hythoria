<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\command;


use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\permission\DefaultPermissions;
use pocketmine\player\Player;
use pocketmine\Server;
use sergittos\hythoria\session\SessionFactory;

abstract class BaseCommandMap extends Command {

    /** @var BaseCommand[] */
    protected array $commands = [];

    public function __construct(string $name, string $description, array $aliases = []) {
        $this->setPermission(DefaultPermissions::ROOT_USER);
        $this->registerDefaultCommands();
        parent::__construct($name, $description, null, $aliases);
    }

    /**
     * @return BaseCommand[]
     */
    public function getCommands(): array {
        return $this->commands;
    }

    private function getCommand(string $alias): ?BaseCommand {
        $alias = strtolower($alias);
        foreach($this->commands as $command) {
            if($command->getName() === $alias or in_array($alias, $command->getAliases())) {
                return $command;
            }
        }
        return null;
    }

    protected function registerCommand(BaseCommand $command): void {
        $this->commands[$command->getName()] = $command;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if(!$sender instanceof Player) {
            $sender->sendMessage("Please, run this command in-game");
            return;
        }

        $session = SessionFactory::getSession($sender);
        if(isset($args[0]) and $this->getCommand($args[0]) !== null and $session !== null) {
            $this->getCommand(array_shift($args))->onCommand($session, $args);
        } else {
            $session->message($this->getHelpMessage());
        }
    }

    abstract public function getHelpMessage(): string;

    abstract protected function registerDefaultCommands(): void;

}