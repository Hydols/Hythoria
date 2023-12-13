<?php

declare(strict_types=1);


namespace sergittos\hythoria\form;


use EasyUI\element\Button;
use EasyUI\variant\SimpleForm;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use sergittos\hythoria\Hythoria;
use sergittos\hythoria\server\Server;
use sergittos\hythoria\session\SessionFactory;

class GameMenuForm extends SimpleForm {

    public function __construct() {
        parent::__construct("Game Menu", "What game do you want to play?");
    }

    protected function onCreation(): void {
        foreach(["BedWars"] as $name) { // hardcoded, todo: recode
            $server = Hythoria::getInstance()->getServerManager()->getServerByName($name);
            $offline = $server === null || $server->getStatus() === Server::MAINTENANCE;

            $button = new Button($name . "\n" . ($offline ? "In maintenance" : "Click to play!"));
            $button->setSubmitListener(function(Player $player) use ($name, $server, $offline) {
                if($offline) {
                    $player->sendMessage(TextFormat::RED . $name . " is in maintenance");
                } else {
                    SessionFactory::getSession($player)->transferTo($server);
                }
            });
        }
    }

    private function addGameButton(string $name): void {
        $server = Hythoria::getInstance()->getServerManager()->getServerByName($name);


    }

}