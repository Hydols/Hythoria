<?php

declare(strict_types=1);


namespace sergittos\hythoria\command\console;


use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\permission\DefaultPermissions;
use pocketmine\player\Player;
use sergittos\hythoria\Hythoria;
use sergittos\hythoria\session\SessionFactory;

class RankCommand extends Command {

    public function __construct() {
        $this->setPermission(DefaultPermissions::ROOT_OPERATOR);
        parent::__construct("rank");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if(!$sender instanceof Player or !isset($args[0])) {
            return;
        }

        $rank = Hythoria::getInstance()->getRankManager()->getRank($args[0]);
        if($rank !== null) {
            SessionFactory::getSession($sender)->setRank($rank);
        }
    }

}