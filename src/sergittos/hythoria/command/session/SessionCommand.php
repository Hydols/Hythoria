<?php

declare(strict_types=1);


namespace sergittos\hythoria\command\session;


use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\permission\DefaultPermissions;
use pocketmine\player\Player;
use sergittos\hythoria\session\Session;
use sergittos\hythoria\session\SessionFactory;

abstract class SessionCommand extends Command {

    public function __construct(string $name, string $description, ?string $usage_message = "", array $aliases = []) {
        $this->setPermission(DefaultPermissions::ROOT_USER);
        parent::__construct($name, $description, $usage_message, $aliases);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if($sender instanceof Player and SessionFactory::hasSession($sender)) {
            $this->onCommand(SessionFactory::getSession($sender), $args);
        }
    }

    abstract protected function onCommand(Session $session, array $args): void;

}