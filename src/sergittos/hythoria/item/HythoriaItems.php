<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\item;


use pocketmine\item\VanillaItems;
use pocketmine\utils\CloningRegistryTrait;
use sergittos\hythoria\form\GameMenuForm;
use sergittos\hythoria\form\LobbySelectorForm;
use sergittos\hythoria\item\presets\FormItem;

/**
 * @method static FormItem GAME_MENU()
 * @method static FormItem LOBBY_SELECTOR()
 */
class HythoriaItems {
    use CloningRegistryTrait;

    protected static function setup(): void {
        self::register("game_menu", new FormItem("Game Menu", GameMenuForm::class, VanillaItems::COMPASS()));
        self::register("lobby_selector", new FormItem("Lobby Selector", LobbySelectorForm::class, VanillaItems::NETHER_STAR()));
    }

    /**
     * @return HythoriaItem[]
     */
    static public function getAll(): array {
        return self::_registryGetAll();
    }

    /**
     * @return HythoriaItem
     */
    static public function get(string $name): object {
        return self::_registryFromString($name);
    }

    static private function register(string $name, HythoriaItem $item) : void{
        self::_registryRegister($name, $item);
    }

}