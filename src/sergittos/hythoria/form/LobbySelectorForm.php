<?php

declare(strict_types=1);


namespace sergittos\hythoria\form;


use EasyUI\element\Button;
use EasyUI\variant\SimpleForm;
use pocketmine\player\Player;
use sergittos\hythoria\Hythoria;
use sergittos\hythoria\server\Server;
use sergittos\hythoria\session\SessionFactory;

class LobbySelectorForm extends SimpleForm {

    public function __construct() {
        parent::__construct("Lobby Selector");
    }

    protected function onCreation(): void {
        foreach(Hythoria::getInstance()->getServerManager()->getServersByType(Server::LOBBY) as $server) {
            $button = new Button($server->getName() . "\n" . "Click to connect!");
            $button->setSubmitListener(function(Player $player) use ($server) {
                SessionFactory::getSession($player)->transferTo($server);
            });
            $this->addButton($button);
        }
    }

}