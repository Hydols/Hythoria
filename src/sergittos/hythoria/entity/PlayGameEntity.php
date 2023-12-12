<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\entity;


use pocketmine\block\BlockTypeIds;
use pocketmine\entity\Human;
use pocketmine\entity\Location;
use pocketmine\entity\Skin;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\math\Vector3;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\permission\DefaultPermissions;
use pocketmine\player\Player;
use sergittos\hythoria\Hythoria;
use sergittos\hythoria\server\Server;
use sergittos\hythoria\session\SessionFactory;
use sergittos\hythoria\utils\ColorUtils;

class PlayGameEntity extends Human {

    private Server $game;

    public function __construct(Location $location, Skin $skin, CompoundTag $nbt) { // todo
        $this->game = Hythoria::getInstance()->getServerManager()->getServer($nbt->getString("game"));
        parent::__construct($location, $skin);
    }

    public function getGame(): Server {
        return $this->game;
    }

    protected function initEntity(CompoundTag $nbt): void {
        parent::initEntity($nbt);

        $this->updateNameTag();
        $this->setNameTagAlwaysVisible();
    }

    public function updateNameTag(): void {
        $this->setNameTag(ColorUtils::translate(
            "{YELLOW}{BOLD}CLICK TO PLAY{RESET}\n" .
            "{AQUA}" . $this->game->getName() . "\n" .
            "{YELLOW}" . $this->game->getPlayers() . " Playing"
        ));
    }

    public function attack(EntityDamageEvent $source): void {
        if(!$source instanceof EntityDamageByEntityEvent) {
            return;
        }
        $damager = $source->getDamager();
        if(!$damager instanceof Player) {
            return;
        }

        if($damager->hasPermission(DefaultPermissions::ROOT_OPERATOR) and
            $damager->getInventory()->getItemInHand()->getTypeId() === BlockTypeIds::BEDROCK) {
            $this->kill();
            return;
        }

        SessionFactory::getSession($damager)->transferTo($this->game);
    }

    public function onInteract(Player $player, Vector3 $clickPos): bool {
        SessionFactory::getSession($player)->transferTo($this->game);
        return true;
    }

    public function saveNBT(): CompoundTag {
        return parent::saveNBT()->setString("game", $this->game->getId());
    }

}